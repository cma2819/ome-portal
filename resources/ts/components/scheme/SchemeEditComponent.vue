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
        <v-subheader>{{ $t('scheme.headers.scheme.edit') }}</v-subheader>
        <fade-transition>
          <v-sheet
            v-if="confirmed"
            key="confirm"
          >
            <scheme-confirm></scheme-confirm>
          </v-sheet>
          <scheme-input
            v-else-if="scheme !== null"
            key="apply"
            :callback="editScheme"
            :scheme="scheme"
            :editable="editable"
          ></scheme-input>
          <linear-loading v-else></linear-loading>
        </fade-transition>
      </div>
    </v-col>
  </v-row>
</template>

<style scoped>
.confirm-fade-enter-active, .confirm-fade-leave-active {
  transition: all .5s;
}

.confirm-fade-enter, .confirm-fade-leave-to {
  opacity: 0;
}
</style>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';
import { apiModule } from '../../modules/api';
import SchemeInput from './SchemeInputComponent.vue';
import SchemeConfirm from './SchemeConfirmComponent.vue';
import FadeTransition from '../FadeTransitionComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import { SchemeInputData } from '../../lib/models/event';

@Component({
  components: {
    SchemeInput,
    SchemeConfirm,
    FadeTransition,
    LinearLoading,
  }
})
export default class SchemeEditComponent extends Vue {

  scheme: SchemeInputData|null = null;
  schemeId = 0;
  confirmed = false;
  editable = false;

  async created(): Promise<void> {
    const scheme = await apiModule.getScheme(parseInt(this.$route.params.schemeId));
    this.scheme = {
      name: scheme.name,
      startAt: scheme.startAt,
      endAt: scheme.endAt,
      explanation: scheme.explanation
    };
    this.schemeId = scheme.id;
    this.editable = (scheme.status === 'applied');
  }

  @Emit()
  async editScheme(scheme: SchemeInputData): Promise<void> {

    await apiModule.putScheme(Object.assign({}, scheme, {id: this.schemeId}));
    this.confirmed = true;

  }
}
</script>
