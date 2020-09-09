<template>
  <div>
    <h3>直近のイベント</h3>
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
            v-if="event === null"
            key="loading"
          >
            <v-progress-circular
              class="ma-2"
              indeterminate
              color="white"
            ></v-progress-circular>
          </div>
          <event-information
            v-else
            key="loaded"
            :event="event"
          ></event-information>
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
  event: Event|null = null;

  async created(): Promise<void> {
    const response = await apiModule.getLatestEvent();
    this.event = response;
  }

}
</script>
