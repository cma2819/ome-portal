<template>
  <v-chip
    label
    :color="color"
  >
    {{ statusLabel }}
  </v-chip>
</template>

<script lang="ts">
import { OengusSelectionStatus } from 'oengus-api';
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class SubmissionSelectionResultComponent extends Vue {
  @Prop(String)
  readonly status!: OengusSelectionStatus;

  get statusLabel(): string {
      return this.$t(`submission.line.status.${this.status.toLowerCase()}`).toString();
  }

  get color(): string {
    const colors = {
      VALIDATED: 'primary',
      TODO: 'secondary',
      BONUS: 'info',
      REJECTED: '',
    }

    return colors[this.status];
  }
}
</script>
