<template>
  <v-chip color="primary">
    {{ plan.name }}
  </v-chip>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { EventPlan } from '../../lib/models/event';

import SchemeListItemStatus from './SchemeListItemStatusComponent.vue';

@Component({
  components: {
    SchemeListItemStatus
  }
})
export default class PlanListItemComponent extends Vue {
  @Prop(Object)
  readonly plan!: EventPlan;
}
</script>
