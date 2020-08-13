import { getModule, Module, Action } from 'vuex-module-decorators';
import store from '../plugins/store';
import { ApiClient } from '../lib/apiClient';
import { Timeline, Tweet, TwitterUploadMedia } from '../lib/models/twitter';
import { User } from '../lib/models/auth';

@Module(({ dynamic: true, store, name: 'api', namespaced: true }))
class Api extends ApiClient {

  @Action
  public updateBearerToken(token: string): void {
    this._updateBearerToken(token);
  }

  @Action
  public updateHost(host: string): void {
    this._updateHost(host);
  }

  @Action
  public async getTweets(): Promise<Timeline> {
    try {
      const response = await this.get('twitter/tweets');
      return response;
    } catch (e) {
      console.error(e);
      return [];
    }
  }

  @Action
  public async postTweet(payload: { text: string; mediaIds: Array<string> }): Promise<Tweet> {
    const response = await this.post({
      endpoint: 'twitter/tweets',
      params: payload
    });
    return response;
  }

  @Action
  public async postMedia(media: File): Promise<TwitterUploadMedia> {
    const formData = new FormData();
    formData.append('media', media);
    const response = await this.post({
      endpoint: 'twitter/medias',
      params: formData
    });
    return response;
  }

  @Action
  public async deleteTweet(id: string): Promise<boolean> {
    await this.delete({
      endpoint: 'twitter/tweets',
      id: id
    });
    return true;
  }

  @Action
  public async getAuthMe(): Promise<User> {
    const response = await this.get('auth/me');
    return response;
  }
}

export const apiModule = getModule(Api);
