<template>
  <v-card>
    <v-card-subtitle>
      {{ $t('scheme.headers.plan.list') }}
    </v-card-subtitle>
    <v-card-text>
      <fade-transaction>
        <div
          v-if="plans !== null"
          key="list"
        >
          <plan-list-item
            v-for="plan in plans"
            :key="plan.id"
            :plan="plan"
            class="ma-1"
          ></plan-list-item>
        </div>
        <div
          v-else
          key="loading"
        >
          <linear-loading></linear-loading>
        </div>
      </fade-transaction>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import { EventPlan } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

import PlanListItem from './PlanListItemComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import FadeTransaction from '../FadeTransitionComponent.vue';

@Component({
    components: {
      PlanListItem,
      LinearLoading,
      FadeTransaction,
    }
  })
export default class PlanIndexComponent extends Vue {
  plans: Array<EventPlan>|null = null;

  async mounted():Promise<void> {
    try {
      const user = await apiModule.getAuthMe();
      this.plans = await apiModule.getPlans({
        planner: user.id,
      });

    } catch (e) {
      // do nothing
    }
  }
}
</script>
