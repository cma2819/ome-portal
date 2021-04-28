<template>
  <v-chip
    :to="{
      name: 'edit',
      params: {
        schemeId: scheme.id
      }
    }"
    :color="getChipColor(scheme.status)"
  >
    {{ scheme.name }}
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { EventScheme, SchemeStatus } from '../../lib/models/event';

import SchemeListItemStatus from './SchemeListItemStatusComponent.vue';

@Component({
  components: {
    SchemeListItemStatus
  }
})
export default class SchemeListItemComponent extends Vue {
  @Prop(Object)
  readonly scheme!: EventScheme;

  getChipColor(status: SchemeStatus): string {
    switch (status) {
      case 'applied':
        return 'secondary';
      case 'approved':
      case 'confirmed':
        return 'primary'
      default:
        return 'default';
    }
  }
}
</script>
