import { getModule, Module, Action } from 'vuex-module-decorators';
import store from '../plugins/store';
import { ApiClient } from '../lib/apiClient';
import { Timeline, Tweet, TwitterUploadMedia } from '../lib/models/twitter';

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
  public async postTweet(text: string, mediaIds: Array<number>): Promise<Tweet> {
    const response = await this.post({
      endpoint: 'twitter/tweets',
      params: {
        text, mediaIds
      }
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
  public async deleteTweet(id: number): Promise<boolean> {
    await this.delete({
      endpoint: 'twitter/tweets',
      id: id.toString()
    });
    return true;
  }
}

export const apiModule = getModule(Api);
