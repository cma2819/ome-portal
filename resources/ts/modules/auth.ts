import { getModule, Module, Action, Mutation, VuexModule } from 'vuex-module-decorators';
import store from '../plugins/store';
import { User as AuthUser } from '../lib/models/auth';
import { apiModule } from './api';

@Module(({ dynamic: true, store, name: 'auth', namespaced: true }))
class Auth extends VuexModule {

  private user: AuthUser|null = null;

  private twitchAuthUrl = '';

  get authUser(): AuthUser|null {
    return this.user;
  }

  get authUrl(): { twitch: string } {
    return {
      twitch: this.twitchAuthUrl,
    }
  }

  @Mutation
  protected _setUser(user: AuthUser): void {
    this.user = user;
  }

  @Mutation
  protected _setTwitchAuthUrl(url: string): void {
    this.twitchAuthUrl = url;
  }

  @Action
  public async authMe(): Promise<void> {
    this._setUser(await apiModule.getAuthMe());
  }

}

export const authModule = getModule(Auth);
