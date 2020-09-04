import { getModule, Module, Action, VuexModule, Mutation } from 'vuex-module-decorators';
import store from '../plugins/store';
import { apiModule } from './api';
import { Event } from 'lib/models/event';

@Module(({ dynamic: true, store, name: 'event', namespaced: true }))
class EventAdmin extends VuexModule {
  events: Array<Event> = [];

  @Mutation
  private _updateEvents(events: Array<Event>) {
    this.events = events;
  }

  @Mutation
  private _deleteEvent(id: string) {
    this.events = this.events.filter((event) => {
      return event.id !== id;
    })
  }

  @Action
  public async updateEvents() {
    this._updateEvents(await apiModule.getEvents());
  }

  @Action
  public async deleteEvent(id: string) {
    this._deleteEvent(id);
  }
}

export const eventAdminModule = getModule(EventAdmin);
