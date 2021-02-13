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
    :loading-text="$t('schedule.labels.loading')"
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

import { OengusCategory, OengusSelection, OengusSubmission } from 'oengus-api';
import SubmissionTableDetail from './SubmissionTableDetailComponent.vue';
import { DataTableHeader } from 'vuetify';

@Component({
  components: {
    SubmissionTableDetail,
  }
})
export default class SubmissionTableComponent extends Vue {
  @Prop(Array)
  submissions!: Array<OengusSubmission>

  @Prop(Array)
  selections!: Array<OengusSelection>;

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

  get gameRowData(): Array<{
    runner: string;
    game: string;
    console: string;
    ratio: string;
    categories: Array<OengusCategory>
  }> {
    return this.submissions.flatMap((submission) => {
      return submission.games.map((game) => {
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
