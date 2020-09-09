<template>
  <div>
    <h3>イベント一覧</h3>
      <transition name="event-list" mode="out-in">
        <div v-if="events.length === 0" key="loading">
          <v-progress-circular class="ma-2" indeterminate color="primary"></v-progress-circular>
        </div>
        <schedule-list v-else :events="events" key="loaded"></schedule-list>
      </transition>
  </div>
</template>

<style scoped>
.event-list-enter-active, .event-list-leave-active, .event-list-item {
  transition: all 2s;
}

.event-list-enter, .event-list-leave-to {
  opacity: 0;
}
</style>

<script lang="ts">
import { getSchedule, OengusRunLine, OengusSchedule, OengusSetupLine } from 'oengus-api';
import { Vue, Component, Prop } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import ScheduleTable from './ScheduleTableComponent.vue';
import ScheduleList from './ScheduleListComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    ScheduleTable,
    ScheduleList,
  }
})
export default class ScheduleIndexComponent extends Vue {
  events: Array<Event> = [];

  async created(): Promise<void> {
    const events = await apiModule.getEvents();
    this.events = events;
  }

}
</script>
