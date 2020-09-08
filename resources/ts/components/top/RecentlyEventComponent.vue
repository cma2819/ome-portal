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
          <div
            v-else
            key="loaded"
          >
            <v-card-title>{{ event.name }}</v-card-title>
            <v-card-subtitle>{{ startDateString }} ～ {{ endDateString }}</v-card-subtitle>
            <v-card-actions>
              <event-submission-status v-if="event.submitsOpen"></event-submission-status>
              <event-selection-status :confirmed="selectionConfirmed"></event-selection-status>
              <event-schedule-status :confirmed="scheduleConfirmed"></event-schedule-status>
            </v-card-actions>
            <v-card-actions>
              <v-btn
                text
                :href="`https://oengus.io/marathon/${event.id}`"
                target="_blank"
              >
                <v-icon left>
                  fas fa-external-link-alt
                </v-icon>イベントページ（Oengus）
              </v-btn>
              <v-btn
                :disabled="!scheduleConfirmed"
                text
                :href="`https://oengus.io/marathon/${event.id}/schedule`"
              >
                <v-icon left>
                  fas fa-clock
                </v-icon>スケジュール
              </v-btn>
            </v-card-actions>
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

import EventSubmissionStatus from './EventSubmissionStatusComponent.vue';
import EventScheduleStatus from './EventScheduleStatusComponent.vue';
import EventSelectionStatus from './EventSelectionStatusComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventSubmissionStatus,
    EventScheduleStatus,
    EventSelectionStatus
  }
})
export default class RecentlyEventComponent extends Vue {
  event: Event|null = null;

  async created(): Promise<void> {
    const response = await apiModule.getLatestEvent();
    this.event = response;
  }

  get startDateString(): string {
    return this.event?.startAt.toLocaleString() || '';
  }

  get endDateString(): string {
    return this.event?.endAt.toLocaleString() || '';
  }

  get selectionConfirmed(): boolean {
    return !(this.event?.status === 'freshed');
  }

  get scheduleConfirmed(): boolean {
    return (this.event?.status === 'scheduled' || this.event?.status === 'closed');
  }
}
</script>
