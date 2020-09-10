<template>
  <div>
    <v-card-title>{{ event.name }}</v-card-title>
    <v-card-subtitle>{{ startDateString }} ～ {{ endDateString }}</v-card-subtitle>
    <v-card-actions>
      <event-closed-status v-if="eventClosed"></event-closed-status>
      <template v-else>
        <event-submission-status v-if="event.submitsOpen"></event-submission-status>
        <event-selection-status
          :confirmed="selectionConfirmed"
          :is-mobile="$vuetify.breakpoint.mobile"
        ></event-selection-status>
        <event-schedule-status
          :confirmed="scheduleConfirmed"
          :is-mobile="$vuetify.breakpoint.mobile"
        ></event-schedule-status>
      </template>
    </v-card-actions>
    <v-card-text>
      <v-btn
        text
        :href="`https://oengus.io/marathon/${event.id}`"
        target="_blank"
        :block="$vuetify.breakpoint.mobile"
      >
        <v-icon left>
          fas fa-external-link-alt
        </v-icon>{{ $t('event.labels.oengus') }}
      </v-btn>
      <v-btn
        :disabled="!scheduleConfirmed"
        text
        :to="{ name: 'detail', params: { id: event.id}}"
        :href="`/schedules/${event.id}`"
        :block="$vuetify.breakpoint.mobile"
      >
        <v-icon left>
          fas fa-clock
        </v-icon>{{ $t('event.labels.schedule') }}
      </v-btn>
    </v-card-text>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import EventSubmissionStatus from './EventSubmissionStatusComponent.vue';
import EventScheduleStatus from './EventScheduleStatusComponent.vue';
import EventSelectionStatus from './EventSelectionStatusComponent.vue';
import EventClosedStatus from './EventClosedStatusComponent.vue';
import { Event } from '../../lib/models/event';

@Component({
  components: {
    EventSubmissionStatus,
    EventScheduleStatus,
    EventSelectionStatus,
    EventClosedStatus,
  }
})
export default class RecentlyEventComponent extends Vue {
  @Prop(Object)
  readonly event!: Event | null;

  get startDateString(): string {
    if (!this.event?.startAt) {
      return '';
    }

    const time = this.event.startAt.toLocaleTimeString();
    const splitTime = time.split(':');
    return `${this.event.startAt.toLocaleDateString()} ${splitTime[0]}:${splitTime[1]}`
  }

  get endDateString(): string {
    if (!this.event?.endAt) {
      return '';
    }

    const time = this.event.endAt.toLocaleTimeString();
    const splitTime = time.split(':');
    return `${this.event.endAt.toLocaleDateString()} ${splitTime[0]}:${splitTime[1]}`
  }

  get selectionConfirmed(): boolean {
    return !(this.event?.status === 'freshed');
  }

  get scheduleConfirmed(): boolean {
    return (this.event?.status === 'scheduled' || this.event?.status === 'closed');
  }

  get eventClosed(): boolean {
    return this.event?.status === 'closed';
  }
}
</script>
