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
        <submission-table-detail :game="item"></submission-table-detail>
      </td>
    </template>
  </v-data-table>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import { OengusGame } from 'oengus-api';
import SubmissionTableDetail from './SubmissionTableDetailComponent.vue';

@Component({
  components: {
    SubmissionTableDetail,
  }
})
export default class SubmissionTableComponent extends Vue {
  @Prop(Array)
  games!: Array<OengusGame>

  expanded = [];
  headers = [
    {
      text: this.$t('submission.labels.games.runner'),
      value: 'runner',
      sortable: true,
      groupable: true,
      divider: true,
      class: 'text--primary',
    },
    {
      text: this.$t('submission.labels.games.name'),
      value: 'game',
      sortable: true,
      groupable: true,
      class: 'text--primary',
    },
    {
      text: this.$t('submission.labels.games.console'),
      value: 'console',
      groupable: true,
      class: 'text--primary',
    },
    {
      text: this.$t('submission.labels.games.ratio'),
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

  get gameRowData(): Array<{
    runner: string;
    game: string;
    console: string;
    ratio: string;
  }> {
    return this.games.map((game) => {
      return {
        id: game.id,
        runner: game.user.usernameJapanese || game.user.username,
        game: game.name,
        console: game.console,
        ratio: game.ratio,
        description: game.description,
        categories: game.categories,
      };
    });
  }
}
</script>
