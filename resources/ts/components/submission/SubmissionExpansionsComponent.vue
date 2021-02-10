<template>
  <v-expansion-panels>
    <v-expansion-panel
      v-for="{game, user} in rows"
      :key="game.id"
    >
      <v-expansion-panel-header>
        {{ game.name }} by {{ user.usernameJapanese || user.username }}
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-row
          dense
          align="center"
          justify="start"
        >
          <v-col cols="auto">
            <v-subheader>
              {{ $t('submission.labels.games.console') }}
            </v-subheader>
          </v-col>
          <v-col cols="auto">
            {{ game.console }}
          </v-col>
          <v-col cols="auto">
            <v-subheader>
              {{ $t('submission.labels.games.ratio') }}
            </v-subheader>
          </v-col>
          <v-col cols="auto">
            {{ game.ratio }}
          </v-col>
        </v-row>
        <submission-table-detail :game="game"></submission-table-detail>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import { OengusGame, OengusSubmission, OengusUser } from 'oengus-api';
import SubmissionTableDetail from './SubmissionTableDetailComponent.vue';

@Component({
  components: {
    SubmissionTableDetail,
  }
})
export default class SubmissionExpansionsComponent extends Vue {
  @Prop(Array)
  submissions!: Array<OengusSubmission>

  get rows(): {game: OengusGame, user: OengusUser}[] {
    return this.submissions.flatMap((submission) => {
      return submission.games.map((game) => {
        return {
          game: game,
          user: submission.user
        };
      });
    });
  }
}
</script>
