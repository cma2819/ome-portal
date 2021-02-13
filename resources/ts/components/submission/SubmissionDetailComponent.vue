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

    <div v-if="event">
      <submission-expansions
        v-if="$vuetify.breakpoint.mobile"
        :selections="selections"
        :submissions="submissions"
      ></submission-expansions>
      <submission-table
        v-else
        :selections="selections"
        :submissions="submissions"
      ></submission-table>
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
import { getSelection, getSubmissions, OengusSelection, OengusSubmission } from 'oengus-api';
import { Vue, Component } from 'vue-property-decorator';

import EventInformation from '../schedule/EventInfomationComponent.vue';
import SubmissionExpansions from './SubmissionExpansionsComponent.vue';
import SubmissionTable from './SubmissionTableComponent.vue';
import { Event } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    EventInformation,
    SubmissionTable,
    SubmissionExpansions,
  }
})
export default class SubmissionDetailComponent extends Vue {
  eventId: string = this.$route.params.id;

  event: Event|null = null;
  submissions: Array<OengusSubmission> = [];
  selections: Array<OengusSelection> = [];

  get selectionDone(): boolean {
    return this.event?.status !== 'freshed';
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
