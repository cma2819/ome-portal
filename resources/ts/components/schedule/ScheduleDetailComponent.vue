<template>
  <div>
    <div>
      <v-btn color="primary" dark :to="{ name: 'index' }">
        <v-icon>fas fa-caret-left</v-icon>
      </v-btn>
    </div>
    <div class="pa-2 mb-2">
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
            :in-spa="true"
          >
          </event-information>
        </transition>
      </v-card>
    </div>

    <schedule-table
      :oengus-lines="scheduleLines"
    ></schedule-table>
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
import { getSchedule, OengusRunLine, OengusSchedule, OengusSetupLine } from 'oengus-api';
import { Vue, Component, Prop } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import ScheduleTable from './ScheduleTableComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    ScheduleTable,
  }
})
export default class ScheduleDetailComponent extends Vue {
  eventId: string = this.$route.params.id;

  event: Event|null = null;
  schedule: OengusSchedule|null = null;

  async created(): Promise<void> {
    const event = await apiModule.getEvent(this.eventId);
    this.event = event;

    const oengusSchedule = await getSchedule(this.event.id);
    this.schedule = oengusSchedule;
  }

  get scheduleLines(): Array<OengusRunLine|OengusSetupLine> {
    return this.schedule?.lines || [];
  }
}
</script>
