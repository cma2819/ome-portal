<template>
  <v-chip
    class="ma-2"
    label
    :color="confirmed ? 'white' : 'grey'"
    outlined
  >
    <v-icon
      v-if="confirmed"
      class="mr-2"
    >
      fas fa-check
    </v-icon>
    <v-icon
      v-else
      class="mr-2"
    >
      fas fa-minus
    </v-icon>
    <span v-if="isMobile">{{ $t('top.event.statuses.selection.mobile') }}</span>
    <span v-else>{{ confirmed ? $t('top.event.statuses.selection.confirmed') : $t('top.event.statuses.selection.progress') }}</span>
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class EventSelectionStatusComponent extends Vue {
  @Prop(Boolean)
  readonly confirmed!: boolean;

  @Prop(Boolean)
  readonly isMobile!: boolean;
}
</script>
