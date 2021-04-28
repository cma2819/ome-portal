<template>
  <v-sheet
    key="input"
    class="pa-4"
  >
    <v-row
      justify="space-around"
      dense
    >
      <v-col>
        <small class="red--text">
          {{ $t('generals.required') }}
        </small>
        <v-text-field
          v-model="name"
          solo
          :label="$t('scheme.labels.name')"
          :messages="$t('scheme.details.name')"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
    >
      <v-col>
        <small class="red--text">
          {{ $t('generals.required') }}
        </small>
        <v-textarea
          v-model="explanation"
          solo
          name="input-7-4"
          :label="$t('scheme.labels.explanation')"
          :messages="$t('scheme.details.explanation')"
        ></v-textarea>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
    >
      <v-col class="text-right">
        <v-btn
          color="primary"
          :loading="loading"
          :disabled="!validated"
          @click="submitPlan"
        >
          {{ $t('scheme.labels.apply') }}
        </v-btn>
      </v-col>
    </v-row>
  </v-sheet>
</template>

<script lang="ts">
import { ApiError } from '../../lib/models/errors';
import { Vue, Component, Emit, Prop } from 'vue-property-decorator';

@Component
export default class PlanInputComponent extends Vue {
  @Prop(Function)
  readonly callback?: (scheme: {name: string; explanation: string}) => Promise<void>;

  loading = false;
  confirmed = false;

  name = '';
  explanation = '';

  get validated(): boolean {
    if (!this.name || !this.explanation) {
      return false;
    }

    return true;
  }

  @Emit()
  async submitPlan(): Promise<void> {
    if (!this.callback) {
      return;
    }

    if (!this.validated) {
      return;
    }

    const params = {
      name: this.name,
      explanation: this.explanation,
    };

    this.loading = true;
    try {
      await this.callback(params);
    } catch (e) {
      alert((e as ApiError).message);
      console.error(e);
    } finally {
      this.loading = false;
    }
  }
}
</script>
