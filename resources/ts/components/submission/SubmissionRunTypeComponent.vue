<template>
  <v-chip label>
    {{ typeLabel }}
  </v-chip>
</template>

<script lang="ts">
import { OengusRunType } from 'oengus-api';
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class SubmissionRunTypeComponent extends Vue {
  @Prop(String)
  readonly type!: OengusRunType;

  get typeLabel(): string {
      return this.$t(`schedule.line.type.${this.type.toLowerCase()}`).toString();
  }
}
</script>
