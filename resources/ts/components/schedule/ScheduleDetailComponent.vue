<template>
  <div>
    <div>
      <v-btn
        color="primary"
        dark
        :to="{ name: 'index' }"
      >
        <v-icon>fas fa-caret-left</v-icon>
      </v-btn>
    </div>
    <div class="pa-2 mb-2">
      <fade-transition>
        <linear-loading v-if="event === null"></linear-loading>
        <v-card
          v-else
          color="primary"
          dark
        >
          <event-information
            key="loaded"
            :event="event"
            :in-spa="true"
          >
          </event-information>
        </v-card>
      </fade-transition>
    </div>

    <schedule-table
      :oengus-lines="scheduleLines"
    ></schedule-table>
  </div>
</template>

<script lang="ts">
import { getSchedule, OengusRunLine, OengusSchedule, OengusSetupLine } from 'oengus-api';
import { Vue, Component } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import ScheduleTable from './ScheduleTableComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    ScheduleTable,
    FadeTransition,
    LinearLoading,
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
