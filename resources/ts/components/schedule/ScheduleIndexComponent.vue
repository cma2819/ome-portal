<template>
  <div>
    <h3>イベント一覧</h3>
    <fade-transition>
      <linear-loading v-if="events.length === 0"></linear-loading>
      <schedule-list
        v-else
        :events="events"
      ></schedule-list>
    </fade-transition>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import ScheduleTable from './ScheduleTableComponent.vue';
import ScheduleList from './ScheduleListComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    ScheduleTable,
    ScheduleList,
    FadeTransition,
    LinearLoading,
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
