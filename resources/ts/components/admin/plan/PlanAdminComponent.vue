<template>
  <v-container>
    <v-row
      justify="space-around"
    >
      <v-col
        cols="12"
        md="8"
        lg="6"
      >
        <plan-admin-list></plan-admin-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import PlanAdminList from './PlanAdminListComponent.vue';

@Component({
  components: {
    PlanAdminList,
  }
})
export default class PlanAdminComponent extends Vue {}
</script>
