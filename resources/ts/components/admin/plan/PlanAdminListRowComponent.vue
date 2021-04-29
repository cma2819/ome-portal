<template>
  <v-container>
    <v-row>
      <v-col
        cols="4"
        lg="2"
      >
        {{ $t('admin.labels.plan.name') }}
      </v-col>
      <v-col cols="auto">
        {{ plan.name }}
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="4"
        lg="2"
      >
        {{ $t('admin.labels.plan.planner') }}
      </v-col>
      <v-col cols="auto">
        {{ plan.planner.username }}
      </v-col>
      <v-col cols="2">
        <v-btn
          small
          icon
          target="_blank"
          :href="`https://discordapp.com/users/${plan.planner.discord.id}`"
        >
          <v-icon>fab fa-discord</v-icon>
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-textarea
          :label="$t('admin.labels.plan.explanation')"
          :value="plan.explanation"
          filled
          readonly
        ></v-textarea>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { EventPlan } from '../../../lib/models/event';

@Component
export default class PlanAdminListRowComponent extends Vue {
  @Prop(Object)
  readonly plan!: EventPlan;
}
</script>
