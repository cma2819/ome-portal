<template>
  <v-data-table
    :headers="headers"
    :items="gameRowData"
    item-key="id"
    :items-per-page="Infinity"
    hide-default-footer
    show-group-by
    class="elevation-1"
    :loading="gameRowData.length === 0"
    :loading-text="$t('submission.labels.loading')"
    :expanded.sync="expanded"
    show-expand
  >
    <template v-slot:expanded-item="{ headers, item }">
      <td :colspan="headers.length">
        <submission-table-detail
          :game="item"
          :selections="selections"
        ></submission-table-detail>
      </td>
    </template>
  </v-data-table>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import { OengusCategory, OengusGame, OengusSelection, OengusSelectionStatus, OengusSubmission } from 'oengus-api';
import SubmissionTableDetail from './SubmissionTableDetailComponent.vue';
import { DataTableHeader } from 'vuetify';

@Component({
  components: {
    SubmissionTableDetail,
  }
})
export default class SubmissionTableComponent extends Vue {
  @Prop(Array)
  readonly submissions!: Array<OengusSubmission>

  @Prop(Array)
  readonly selections!: Array<OengusSelection>;

  @Prop(Array)
  readonly filteredStatus!: Array<OengusSelectionStatus>;

  expanded = [];

  get headers(): DataTableHeader[] {
    return [
      {
        text: this.$t('submission.labels.games.runner').toString(),
        value: 'runner',
        sortable: true,
        groupable: true,
        divider: true,
        class: 'text--primary',
      },
      {
        text: this.$t('submission.labels.games.name').toString(),
        value: 'game',
        sortable: true,
        groupable: true,
        class: 'text--primary',
      },
      {
        text: this.$t('submission.labels.games.console').toString(),
        value: 'console',
        groupable: true,
        class: 'text--primary',
      },
      {
        text: this.$t('submission.labels.games.ratio').toString(),
        value: 'ratio',
        groupable: false,
        class: 'text--primary',
      },
      {
        text: '',
        value: 'data-table-expand',
        groupable: false,
      },
    ];
  }

  filterGameBySelection(game: OengusGame): boolean {
    return game.categories.some((category) => {
      return this.filteredStatus.includes(
        this.selections.find(selection => selection.categoryId === category.id)?.status
        || OengusSelectionStatus.todo
      );
    })
  }

  get gameRowData(): Array<{
    runner: string;
    game: string;
    console: string;
    ratio: string;
    categories: Array<OengusCategory>
  }> {
    return this.submissions.flatMap((submission) => {
      return submission.games.filter((game) => {
        return (
          this.filteredStatus.length === 0
          || this.filterGameBySelection(game)
        );
      }).map((game) => {
        return {
          id: game.id,
          runner: submission.user.usernameJapanese || submission.user.username,
          game: game.name,
          console: game.console,
          ratio: game.ratio,
          description: game.description,
          categories: game.categories,
        };
      });
    });
  }
}
</script>
