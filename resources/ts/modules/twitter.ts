import { getModule, Module, Action, VuexModule, Mutation } from 'vuex-module-decorators';
import store from '../plugins/store';
import { Timeline, Tweet } from '../lib/models/twitter';
import { apiModule } from './api';

@Module(({ dynamic: true, store, name: 'twitter', namespaced: true }))
class Twitter extends VuexModule {
  timeline: Timeline = [];

  @Mutation
  private _updateTimeline(timeline: Timeline): void {
    this.timeline = timeline;
  }

  @Mutation
  private _addTweetToTimeline(tweet: Tweet): void {
    this.timeline = [tweet, ...this.timeline];
  }

  @Action
  public async updateTimeline(): Promise<void> {
    const timeline = await apiModule.getTweets();
    this._updateTimeline(timeline);
  }

  @Action
  public addTweetToTimeline(tweet: Tweet): void {
    this,this._addTweetToTimeline(tweet);
  }
}

export const twitterModule = getModule(Twitter);
