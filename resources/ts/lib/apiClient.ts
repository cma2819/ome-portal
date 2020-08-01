import { VuexModule, Mutation, Action } from 'vuex-module-decorators';
import axios, { AxiosError } from 'axios';
import { ApiError } from './models/errors';

export class ApiClient extends VuexModule {

  protected bearer: string | null = null;
  protected host = 'http://localhost';

  get isAuthenticated(): boolean {
    return this.bearer ? true : false;
  }

  @Mutation
  protected _updateBearerToken(token: string): void {
    this.bearer = token;
  }

  @Mutation
  protected _updateHost(host: string): void {
    this.host = host;
  }

  @Action
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  protected async get(endpoint: string): Promise<any> {
    const headers = this.bearer ? {
      Authorization: `Bearer ${this.bearer}`
    } : null;
    try {
      const response = await axios.get(`${this.host}/${endpoint}`, { headers });
      return response.data;
    } catch (e) {
      throw this.handleError(e);
    }
  }

  @Action
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  protected async post(payload: { endpoint: string, params: any }): Promise<any> {
    const headers = this.bearer ? {
      Authorization: `Bearer ${this.bearer}`
    } : null;
    try {
      const response = await axios.post(`${this.host}/${payload.endpoint}`, payload.params, { headers });
      return response.data;
    } catch (e) {
      throw this.handleError(e);
    }
  }

  @Action
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  protected async put(payload: { endpoint: string, params: any }): Promise<any> {
    const headers = this.bearer ? {
      Authorization: `Bearer ${this.bearer}`
    } : null;
    try {
      const response = await axios.put(`${this.host}/${payload.endpoint}`, payload.params, { headers });
      return response.data;
    } catch (e) {
      throw this.handleError(e);
    }
  }

  private handleError(error: AxiosError): ApiError {
    if (error.response) {
      return {
        status: error.response.status,
        message: error.response.data
      };
    } else {
      return {
        message: error.message
      };
    }
  }
}
