<template>
  <v-expansion-panels>
    <v-expansion-panel
      v-for="game in games"
      :key="game.id"
    >
      <v-expansion-panel-header>
        {{ game.name }} by {{ game.user.usernameJapanese || game.user.username }}
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

import { OengusGame } from 'oengus-api';
import SubmissionTableDetail from './SubmissionTableDetailComponent.vue';

@Component({
  components: {
    SubmissionTableDetail,
  }
})
export default class SubmissionExpansionsComponent extends Vue {
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
