<template>
  <v-chip
    class="ma-2"
    label
    color="white"
    outlined
  >
    <v-icon class="mr-2">
      fas fa-calendar-check
    </v-icon>
    {{ $t('top.event.statuses.closed') }}
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class EventClosedStatusComponent extends Vue {}
</script>
