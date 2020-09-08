<template>
  <div>
    <h3>直近のイベント</h3>
    <div class="pa-2">
    <v-card color="primary" dark>
      <v-card-title>Puzzle Game RTA Festival</v-card-title>
      <v-card-subtitle>2020-10-12 ～　...</v-card-subtitle>
      <v-card-actions>
        <event-submission-status></event-submission-status>
        <event-selection-status :confirmed="false"></event-selection-status>
        <event-schedule-status :confirmed="false"></event-schedule-status>
      </v-card-actions>
      <v-card-actions>
        <v-btn text>
          <v-icon left>
            fas fa-external-link-alt
          </v-icon>
          イベントページ（Oengus）
        </v-btn>
        <v-btn text>
          <v-icon left>
            fas fa-clock
          </v-icon>
          スケジュール
        </v-btn>
      </v-card-actions>
    </v-card>
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import EventSubmissionStatus from './EventSubmissionStatusComponent.vue';
import EventScheduleStatus from './EventScheduleStatusComponent.vue';
import EventSelectionStatus from './EventSelectionStatusComponent.vue';

@Component({
  components: {
    EventSubmissionStatus,
    EventScheduleStatus,
    EventSelectionStatus
  }
})
export default class RecentlyEventComponent extends Vue {
}
</script>
