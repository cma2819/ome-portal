<template>
  <div>
    <v-subheader>直近のイベント</v-subheader>
    <div class="pa-2">
      <v-card
        color="primary"
        dark
      >
        <transition
          name="event"
          mode="out-in"
        >
          <div
            v-if="events.length === 0"
            key="loading"
          >
            <v-progress-circular
              class="ma-2"
              indeterminate
              color="white"
            ></v-progress-circular>
          </div>
          <div
            v-else
            key="loaded"
          >
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
        </transition>
      </v-card>
    </div>
  </div>
</template>

<style scoped>
.event-enter-active, .event-leave-active {
  transition: all .5s;
}

.event-enter, .event-leave-to {
  opacity: 0;
}
</style>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation
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
