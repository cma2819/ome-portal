<template>
  <v-container>
    <v-row>
      <v-col>
        <v-subheader>
          {{ $t('submission.labels.games.description') }}
        </v-subheader>
        {{ game.description }}
      </v-col>
    </v-row>
    <v-subheader>
      {{ $t('submission.labels.categories.name') }}
    </v-subheader>
    <v-card
      v-for="category in game.categories"
      :key="category.id"
      class="my-2"
    >
      <v-card-subtitle class="black--text">
        {{ category.name }}
        <submission-run-type :type="category.type"></submission-run-type>
        <v-btn
          icon
          target="ome-submission-video"
          :href="category.video"
        >
          <v-icon>
            fas fa-film
          </v-icon>
        </v-btn>
        <div
          v-if="isRaceRun(category)"
          class="ml-2"
        >
          <div
            v-for="opponent in category.opponentDtos"
            :key="opponent.id"
          >
            vs. {{ opponent.user.usernameJapanese || opponent.user.username }}
            <v-btn
              icon
              target="ome-submission-video"
              :href="opponent.video"
            >
              <v-icon>
                fas fa-film
              </v-icon>
            </v-btn>
          </div>
        </div>
        <div
          v-else-if="isCoopRun(category) || isCoopRaceRun(category)"
          class="ml-2"
        >
          <div
            v-for="opponent in category.opponentDtos"
            :key="opponent.id"
          >
            with. {{ opponent.user.usernameJapanese || opponent.user.username }}
            <v-btn
              icon
              target="ome-submission-video"
              :href="opponent.video"
            >
              <v-icon>
                fas fa-film
              </v-icon>
            </v-btn>
          </div>
        </div>
      </v-card-subtitle>
      <v-card-text class="black--text">
        <v-row>
          <v-col cols="auto">
            {{ $t('submission.labels.categories.estimate') }}
          </v-col>
          <v-col>
            {{ isoTimeString(category.estimate) }}
          </v-col>
        </v-row>
        <v-row>
          <v-col
            cols="12"
            md="auto"
          >
            {{ $t('submission.labels.categories.description') }}
          </v-col>
          <v-col>
            {{ category.description }}
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script lang="ts">
import { OengusCategory, OengusRunType } from 'oengus-api';
import { Vue, Component, Prop } from 'vue-property-decorator';
import { isoTimeString, isRaceRun, isCoopRun, isCoopRaceRun } from '../../lib/utils/oengus';

import SubmissionRunType from '../submission/SubmissionRunTypeComponent.vue';

@Component({
  components: {
    SubmissionRunType,
  },
  methods: {
    isoTimeString,
    isRaceRun,
    isCoopRun,
    isCoopRaceRun,
  }
})
export default class SubmissionTableDetailComponent extends Vue {
  @Prop(Object)
  readonly game!: {
    description: string;
    categories: OengusCategory[];
  }

  getTypeLabel(type: OengusRunType): string {
      return this.$t(`schedule.line.type.${type.toLowerCase()}`).toString();
  }
}
</script>
