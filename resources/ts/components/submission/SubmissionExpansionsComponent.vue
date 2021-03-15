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
        <submission-table-detail
          :game="game"
          :selections="selections"
        >
        </submission-table-detail>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import { OengusGame, OengusSelection, OengusSelectionStatus, OengusSubmission, OengusUser } from 'oengus-api';
import SubmissionTableDetail from './SubmissionTableDetailComponent.vue';

@Component({
  components: {
    SubmissionTableDetail,
  }
})
export default class SubmissionExpansionsComponent extends Vue {
  @Prop(Array)
  readonly submissions!: Array<OengusSubmission>

  @Prop(Array)
  readonly selections!: Array<OengusSelection>;

  @Prop(Array)
  readonly filteredStatus!: Array<OengusSelectionStatus>;

  filterGameBySelection(game: OengusGame): boolean {
    return game.categories.some((category) => {
      return this.filteredStatus.includes(
        this.selections.find(selection => selection.categoryId === category.id)?.status
        || OengusSelectionStatus.todo
      );
    })
  }

  get rows(): {game: OengusGame, user: OengusUser}[] {
    return this.submissions.flatMap((submission) => {
      return submission.games.map((game) => {
        return {
          game: game,
          user: submission.user
        };
      });
    }).filter((row) => {
      return (
        this.filteredStatus.length === 0
        || this.filterGameBySelection(row.game)
      );
    });
  }
}
</script>
