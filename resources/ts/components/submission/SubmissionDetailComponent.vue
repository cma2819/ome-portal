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
            :event="event"
            :in-spa="true"
          >
          </event-information>
        </v-card>
      </fade-transition>
    </div>

    <div v-if="event">
      <v-select
        v-if="selectionDone && filterItems"
        v-model="filterStatus"
        :label="$t('submission.labels.filter')"
        :items="filterItems"
        multiple
        chips
        solo
      ></v-select>
      <submission-expansions
        v-if="$vuetify.breakpoint.mobile"
        :selections="selections"
        :submissions="submissions"
        :filtered-status="filterStatus"
      ></submission-expansions>
      <submission-table
        v-else
        :selections="selections"
        :submissions="submissions"
        :filtered-status="filterStatus"
      ></submission-table>
    </div>
  </div>
</template>

<script lang="ts">
import { getSelection, getSubmissions, OengusSelection, OengusSelectionStatus, OengusSubmission } from 'oengus-api';
import { Vue, Component } from 'vue-property-decorator';

import EventInformation from '../schedule/EventInfomationComponent.vue';
import SubmissionExpansions from './SubmissionExpansionsComponent.vue';
import SubmissionTable from './SubmissionTableComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    SubmissionTable,
    SubmissionExpansions,
    FadeTransition,
    LinearLoading
  }
})
export default class SubmissionDetailComponent extends Vue {
  eventId: string = this.$route.params.id;

  event: Event|null = null;
  submissions: Array<OengusSubmission> = [];
  selections: Array<OengusSelection> = [];
  filterStatus: Array<OengusSelectionStatus> = [];

  get selectionDone(): boolean {
    return this.event?.status !== 'freshed';
  }

  get filterItems(): Array<{ text: string; value: OengusSelectionStatus }> {
    const inSubmissionStatus = this.selections.map((selection) => {
      return selection.status;
    });

    return [
      {
        text: this.$t('submission.line.status.validated').toString(),
        value: OengusSelectionStatus.validated,
      },
      {
        text: this.$t('submission.line.status.rejected').toString(),
        value: OengusSelectionStatus.rejected,
      },
      {
        text: this.$t('submission.line.status.bonus').toString(),
        value: OengusSelectionStatus.bonus,
      },
      {
        text: this.$t('submission.line.status.todo').toString(),
        value: OengusSelectionStatus.todo,
      },
    ].filter((item) => {
      return inSubmissionStatus.includes(item.value);
    });
  }

  async created(): Promise<void> {
    const event = await apiModule.getEvent(this.eventId);
    this.event = event;

    const oengusGames = await getSubmissions(this.event.id);
    this.submissions = oengusGames;

    if (this.event.status !== 'freshed') {
      const selections = await getSelection(this.event.id);
      this.selections = Object.values(selections);
    }
  }
}
</script>
