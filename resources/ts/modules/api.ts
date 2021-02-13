import { getModule, Module, Action } from 'vuex-module-decorators';
import store from '../plugins/store';
import { ApiClient } from '../lib/apiClient';
import { Timeline, Tweet, TwitterUploadMedia } from '../lib/models/twitter';
import { User as AuthUser, UserProfile } from '../lib/models/auth';
import { User } from '../lib/models/user';
import { Role } from 'lib/models/role';
import { RelateType, Event, Status, EventScheme, SchemeStatus } from 'lib/models/event';
import { Paginate } from '../lib/models/page';

@Module(({ dynamic: true, store, name: 'api', namespaced: true }))
class Api extends ApiClient {

  get isAuthenticated(): boolean {
    return this.bearer ? true : false;
  }

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
  public async getAuthMe(): Promise<AuthUser> {
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
  public async getActiveEvents(): Promise<Array<Event>> {
    const response = await this.get('events/active');
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
  public async getEvent(id: string): Promise<Event> {
    const response = await this.get(`events/${id}`);
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

  @Action
  public async getSchemes(payload: {planner?: number, status?: Array<string>, startAt?: Date, endAt?: Date}): Promise<Array<EventScheme>> {
    const query = new URLSearchParams();
    Object.entries(payload).forEach(([key, value]) => {
      if (value) {
        if (value instanceof Array) {
          value.forEach((v) => {
            query.append(key, v);
          })
        }
        query.append(key, value.toString());
      }
    })
    const response = await this.get('schemes?' + query.toString());
    return response.map((scheme: {
      id: number,
      name: string,
      planner: UserProfile,
      startAt: string,
      status: string,
      endAt: string,
      explanation: string,
      detail: string,
    }) => {
      return {
        id: scheme.id,
        name: scheme.name,
        planner: scheme.planner,
        status: scheme.status,
        startAt: scheme.startAt && new Date(Date.parse(scheme.startAt)),
        endAt: scheme.endAt && new Date(Date.parse(scheme.endAt)),
        explanation: scheme.explanation,
        detail: scheme.detail,
      }
    });
  }

  @Action
  public async getScheme(id: number): Promise<EventScheme> {
    const response = await this.get(`schemes/${id}`);
    return {
      id: response.id,
      name: response.name,
      planner: response.planner,
      status: response.status,
      startAt: response.startAt && new Date(Date.parse(response.startAt)),
      endAt: response.endAt && new Date(Date.parse(response.endAt)),
      explanation: response.explanation,
      detail: response.detail,
    }
  }

  @Action
  public async postScheme(payload: {name: string, startAt: Date|null, endAt: Date|null, explanation: string}): Promise<EventScheme> {
    const response = await this.post({
      endpoint: 'schemes',
      params: {
        name: payload.name,
        startAt: payload.startAt && payload.startAt.toISOString(),
        endAt: payload.endAt && payload.endAt.toISOString(),
        explanation: payload.explanation,
      }
    });
    return {
      id: response.id,
      name: response.name,
      planner: response.planner,
      status: response.status,
      startAt: new Date(Date.parse(response.startAt)),
      endAt: new Date(Date.parse(response.endAt)),
      explanation: response.explanation,
      detail: response.detail,
    };
  }

  @Action
  public async putScheme(payload: {id: number, name: string, startAt: Date|null, endAt: Date|null, explanation: string}): Promise<boolean> {
    await this.put({
      endpoint: 'schemes',
      id: payload.id.toString(),
      params: {
        name: payload.name,
        startAt: payload.startAt,
        endAt: payload.endAt,
        explanation: payload.explanation
      }
    });

    return true;
  }

  @Action
  public async putSchemeStatus(payload: {id: number, status: SchemeStatus, reply: string}) {
    await this.put({
      endpoint: `schemes/${payload.id}/status`,
      params: {
        status: payload.status,
        reply: payload.reply,
      }
    });
  }

  @Action
  public async getUsers(page?: number): Promise<Paginate<User>> {
    const query = new URLSearchParams();

    if (page) {
      query.append('page', `${page}`);
    }
    const response = await this.get(`users?${query.toString()}`);

    return {
      prev: response.prev,
      current: response.current,
      next: response.next,
      data: response.data,
    };
  }
}

export const apiModule = getModule(Api);
