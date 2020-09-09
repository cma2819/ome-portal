<template>
  <div>
    <div key="loaded">
      <div v-for="event in events" :key="event.id" class="pa-2 mb-2 event-list-item">
        <v-card color="primary" dark>
          <event-information :event="event"></event-information>
        </v-card>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { getSchedule, OengusRunLine, OengusSchedule, OengusSetupLine } from 'oengus-api';
import { Vue, Component, Prop } from 'vue-property-decorator';

import EventInformation from './EventInfomationComponent.vue';
import { Event } from '../../lib/models/event';

@Component({
  components: {
    EventInformation
  }
})
export default class ScheduleListComponent extends Vue {
  @Prop(Array)
  readonly events!: Array<Event>;
}
</script>
