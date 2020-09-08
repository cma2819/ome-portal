<template>
  <v-chip
    class="ma-2"
    label
    color="white"
    outlined
  >
    <v-icon class="mr-2">fas fa-edit</v-icon>
    {{$t('top.event.statuses.submission.open')}}
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class EventSubmissionStatusComponent extends Vue {}
</script>
