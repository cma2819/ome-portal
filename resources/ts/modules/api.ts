import { getModule, Module, Action } from 'vuex-module-decorators';
import store from '../plugins/store';
import { ApiClient } from '../lib/apiClient';
import { Timeline, Tweet, TwitterUploadMedia } from '../lib/models/twitter';
import { User } from '../lib/models/auth';
import { Role } from 'lib/models/role';
import { RelateType, Event, Status } from 'lib/models/event';

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

  @Action
  public async getRoles(): Promise<Array<Role>> {
    const response = await this.get('roles');
    return response;
  }

  @Action
  public async putRole(payload: {id: string; permissions: Array<string>}): Promise<boolean> {
    await this.put({
      endpoint: 'roles',
      id: payload.id,
      params: {
        permissions: payload.permissions
      }
    });
    return true;
  }

  @Action
  public async getEvents(): Promise<Array<Event>> {
    const response = await this.get('events');
    return response.map((event: {
      id: string;
      name: string;
      startAt: string;
      endAt: string;
      relateType: RelateType;
      slug: string;
      submitsOpen: boolean;
      status: Status
    }) => {

    return {
      id: event.id,
      name: event.name,
      startAt: new Date(Date.parse(event.startAt)),
      endAt: new Date(Date.parse(event.endAt)),
      relateType: event.relateType,
      slug: event.slug,
      submitsOpen: event.submitsOpen,
      status: event.status,
    };
    });
  }

  @Action
  public async postEvent(payload: {id: string, relateType: RelateType, slug: string}): Promise<Event> {
    const response = await this.post({
      endpoint: 'events',
      params: {
        id: payload.id,
        relateType: payload.relateType,
        slug: payload.slug
      }
    });

    return {
      id: response.id,
      name: response.name,
      startAt: new Date(Date.parse(response.startAt)),
      endAt: new Date(Date.parse(response.endAt)),
      relateType: response.relateType,
      slug: response.slug,
      submitsOpen: response.submitsOpen,
      status: response.status,
    };
  }

  @Action
  public async putEvent(payload: {id: string, relateType: RelateType, slug: string}): Promise<Event> {
    const response = await this.put({
      endpoint: 'events',
      id: payload.id,
      params: {
        relateType: payload.relateType,
        slug: payload.slug
      }
    });

    return {
      id: response.id,
      name: response.name,
      startAt: new Date(Date.parse(response.startAt)),
      endAt: new Date(Date.parse(response.endAt)),
      relateType: response.relateType,
      slug: response.slug,
      submitsOpen: response.submitsOpen,
      status: response.status,
    };
  }

  @Action
  public async deleteEvent(id: string): Promise<boolean> {
    await this.delete({
      endpoint: 'events',
      id
    });
    return true;
  }

  @Action
  public async getLatestEvent(): Promise<Event> {
    const response = await this.get('events/latest');
    return {
      id: response.id,
      name: response.name,
      startAt: new Date(Date.parse(response.startAt)),
      endAt: new Date(Date.parse(response.endAt)),
      relateType: response.relateType,
      slug: response.slug,
      submitsOpen: response.submitsOpen,
      status: response.status,
    };
  }
}

export const apiModule = getModule(Api);
