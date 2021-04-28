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
        <v-subheader>{{ $t('scheme.headers.scheme.apply') }}</v-subheader>
        <fade-transition>
          <v-sheet
            v-if="confirmed"
            key="confirm"
          >
            <scheme-confirm></scheme-confirm>
          </v-sheet>
          <scheme-input
            v-else
            key="apply"
            :callback="applyScheme"
          ></scheme-input>
        </fade-transition>
      </div>
    </v-col>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';
import { apiModule } from '../../modules/api';
import SchemeInput from './SchemeInputComponent.vue';
import SchemeConfirm from './SchemeConfirmComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';

@Component({
  components: {
    SchemeInput,
    SchemeConfirm,
    FadeTransition,
  }
})
export default class SchemeApplyComponent extends Vue {

  confirmed = false;

  @Emit()
  async applyScheme(scheme: {
    name: string,
    startAt: Date|null,
    endAt: Date|null,
    explanation: string,
  }): Promise<void> {

    await apiModule.postScheme(scheme);
    this.confirmed = true;

  }
}
</script>
