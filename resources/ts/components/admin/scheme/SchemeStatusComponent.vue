<template>
  <v-chip
    label
    :color="statusClass"
  >
    {{ statusLabel }}
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import {  SchemeStatus } from '../../../lib/models/event';

@Component
export default class SchemeStatusComponent extends Vue {
  @Prop(String)
  readonly status!: SchemeStatus;

  get statusClass(): string {
    switch (this.status) {
      case 'confirmed':
        return 'info'
      case 'denied':
        return 'secondary';
      default:
        return 'primary'
    }
  }

  get statusLabel(): string {
    switch (this.status) {
      case 'approved':
        return this.$t('scheme.status.approved').toString();
      case 'applied':
        return this.$t('scheme.status.applied').toString();
      case 'confirmed':
        return this.$t('scheme.status.confirmed').toString();
      case 'denied':
        return this.$t('scheme.status.denied').toString();
      default:
        return this.status;
    }
  }
}
</script>
