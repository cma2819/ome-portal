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
    <span v-if="isMobile">{{ $t('top.event.statuses.schedule.mobile') }}</span>
    <span v-else>{{ confirmed ? $t('top.event.statuses.schedule.confirmed') : $t('top.event.statuses.schedule.progress') }}</span>
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class EventScheduleStatusComponent extends Vue {
  @Prop(Boolean)
  readonly confirmed!: boolean;

  @Prop(Boolean)
  readonly isMobile!: boolean;
}
</script>
