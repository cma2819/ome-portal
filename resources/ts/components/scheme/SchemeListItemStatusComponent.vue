<template>
  <v-chip
    class="ma-2"
    label
    color="white"
    outlined
  >
    <span v-if="status === 'denied'">
      <v-icon
        class="mr-2"
      >
        fas fa-times
      </v-icon>
      {{ statusLabel }}
    </span>
    <span v-else-if="status === 'confirmed'">
      <v-icon
        class="mr-2"
      >
        fas fa-check
      </v-icon>
      {{ statusLabel }}
    </span>
    <span v-else>
      <v-icon
        class="mr-2"
      >
        fas fa-clock
      </v-icon>
      {{ statusLabel }}
    </span>
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { SchemeStatus } from '../../lib/models/event';

@Component
export default class SchemeListItemStatusComponent extends Vue {
  @Prop(String)
  readonly status!: SchemeStatus;

  get statusLabel(): string {
    switch (this.status) {
      case 'applied':
        return this.$t('scheme.status.applied').toString();
      case 'approved':
        return this.$t('scheme.status.approved').toString();
      case 'denied':
        return this.$t('scheme.status.denied').toString();
      case 'confirmed':
        return this.$t('scheme.status.confirmed').toString();
      default:
        return this.status;
    }
  }
}
</script>
