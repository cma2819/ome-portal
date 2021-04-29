<template>
  <v-expansion-panels>
    <v-expansion-panel
      v-for="plan in plans"
      :key="plan.id"
      :style="{
        borderLeft: `4px solid ${$vuetify.theme.themes.light.secondary}`
      }"
    >
      <v-expansion-panel-header>
        {{ plan.name }}
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <plan-admin-list-row :plan="plan"></plan-admin-list-row>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import { apiModule } from '../../../modules/api';
import { EventPlan } from '../../../lib/models/event';
import PlanAdminListRow from './PlanAdminListRowComponent.vue';

@Component({
  components: {
    PlanAdminListRow,
  }
})
export default class PlanAdminListComponent extends Vue {
  plans: Array<EventPlan> = [];

  async created (): Promise<void> {
    this.plans = await apiModule.getPlans({});
  }
}
</script>
