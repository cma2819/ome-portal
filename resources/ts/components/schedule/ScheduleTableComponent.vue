<template>
  <v-data-table
    :headers="headers"
    :items="oengusTableData"
    :items-per-page="Infinity"
    hide-default-footer
    group-by="date"
    show-group-by
    class="elevation-1"
    :loading="oengusTableData.length === 0"
    :loading-text="$t('schedule.labels.loading')"
  ></v-data-table>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import { OengusRunLine, OengusRunType, OengusSetupLine } from 'oengus-api';
import { parse } from 'iso8601-duration';

@Component
export default class ScheduleTableComponent extends Vue {
  @Prop(Array)
  oengusLines!: Array<OengusRunLine|OengusSetupLine>

  headers = [
    {
      text: this.$t('schedule.labels.date'),
      value: 'date',
      sortable: false,
      groupable: true,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.time'),
      value: 'time',
      sortable: false,
      groupable: false,
      divider: true,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.runner'),
      value: 'runner',
      groupable: false,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.game'),
      value: 'game',
      groupable: false,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.category'),
      value: 'category',
      groupable: false,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.type'),
      value: 'type',
      groupable: false,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.console'),
      value: 'console',
      groupable: false,
      class: 'text--primary',
    },
    {
      text: this.$t('schedule.labels.estimate'),
      value: 'estimate',
      groupable: false,
      class: 'text--primary',
    }
  ];

  get oengusTableData(): Array<{
    date: string;
    time: string;
    runner: string[];
    game: string;
    category: string;
    type: string;
    console: string;
    estimate: string;
  }> {
    return this.oengusLines.filter((line) => {
      return line.setupBlock === false;
    }).map((line) => {

        const lineDate = new Date(Date.parse(line.date));
        const splitTime = lineDate.toLocaleTimeString().split(':')

        return {
          date: lineDate.toLocaleDateString(),
          time: `${splitTime[0]}:${splitTime[1]}`,
          runner: line.runners.map((runner) => {
            return runner.usernameJapanese || runner.username;
          }) || [],
          game: line.gameName || '-',
          category: line.categoryName || '-',
          type: this.getTypeLabel(line.type),
          console: line.console || '-',
          estimate: this.getTimeString(line.estimate)
        }
    });
  }

  getTypeLabel(type: OengusRunType): string {
      return this.$t(`schedule.line.type.${type.toLowerCase()}`).toString();
  }

  getTimeString(isoTime: string): string {
    const duration = parse(isoTime);

    return [
      ((duration.days || 0 * 24) + (duration.hours || 0)).toString().padStart(2, '0'),
      (duration.minutes || 0).toString().padStart(2, '0'),
      (duration.seconds || 0).toString().padStart(2, '0')
    ].join(':');
  }
}
</script>
