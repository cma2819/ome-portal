<template>
  <div>
    <v-subheader>直近のイベント</v-subheader>
    <div class="pa-2">
      <fade-transition>
        <linear-loading v-if="events.length === 0"></linear-loading>
        <v-card
          v-else
          color="primary"
          dark
        >
          <div>
            <div
              v-for="event in events"
              :key="event.id"
            >
              <event-information
                :event="event"
                :is-spa="false"
              ></event-information>
              <v-divider></v-divider>
            </div>
          </div>
        </v-card>
      </fade-transition>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    LinearLoading,
    FadeTransition,
  }
})
export default class RecentlyEventComponent extends Vue {
  events: Event[] = [];

  async created(): Promise<void> {
    const response = await apiModule.getActiveEvents();
    response.sort((l, r) => {
      return l.startAt.valueOf() - r.startAt.valueOf();
    })
    this.events = response;
  }

}
</script>
