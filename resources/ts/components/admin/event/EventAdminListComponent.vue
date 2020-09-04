<template>
  <div>
    <h3>{{ $t('admin.event.headers.list') }}</h3>
    <div v-if="events.length === 0">
      <v-progress-circular
        indeterminate
      ></v-progress-circular>
    </div>
    <div
      v-else
      class="pa-2"
    >
      <transition-group
        name="events"
        tag="v-expansion-panels"
      >
        <v-expansion-panel
          v-for="event in events"
          :key="event.id"
          :style="{
            borderLeft: `4px solid ${$vuetify.theme.themes.light.secondary}`
          }"
        >
          <v-expansion-panel-header>{{ event.name }} - {{ event.slug }}</v-expansion-panel-header>
          <v-expansion-panel-content>
            <event-admin-list-row
              :event="event"
            ></event-admin-list-row>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </transition-group>
    </div>
  </div>
</template>

<style scoped>
.events-enter-active, .events-leave-active {
  transition: all 1s;
}

.events-enter, .events-leave-to {
  opacity: 0;
  transform: translateX(10px);
}
</style>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import { Event } from '../../../lib/models/event';

import EventAdminListRow from './EventAdminListRowComponent.vue';
import { eventAdminModule } from '../../../modules/events';

@Component({
  components: {
    EventAdminListRow
  }
})
export default class EventAdminListComponent extends Vue {

  async created(): Promise<void> {
    eventAdminModule.updateEvents();
  }

  get events(): Array<Event> {
    return eventAdminModule.events;
  }
}
</script>
