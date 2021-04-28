<template>
  <v-row
    justify="space-around"
  >
    <v-col
      cols="12"
      md="10"
      lg="8"
    >
      <div>
        <v-btn
          color="primary"
          dark
          :to="{ name: 'index' }"
        >
          <v-icon>fas fa-caret-left</v-icon>
        </v-btn>
      </div>
      <div class="pa-2">
        <v-subheader>{{ $t('scheme.headers.plan.apply') }}</v-subheader>
        <fade-transition>
          <v-sheet
            v-if="confirmed"
            key="confirm"
          >
            <plan-confirm></plan-confirm>
          </v-sheet>
          <plan-input
            v-else
            key="apply"
            :callback="applyPlan"
          ></plan-input>
        </fade-transition>
      </div>
    </v-col>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';
import { apiModule } from '../../modules/api';
import PlanInput from './PlanInputComponent.vue';
import PlanConfirm from './PlanConfirmComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';

@Component({
  components: {
    PlanInput,
    PlanConfirm,
    FadeTransition,
  }
})
export default class PlanApplyComponent extends Vue {

  confirmed = false;

  @Emit()
  async applyPlan(plan: {
    name: string,
    explanation: string,
  }): Promise<void> {

    await apiModule.postPlan(plan);
    this.confirmed = true;

  }
}
</script>
