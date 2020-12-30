<template>
  <v-container>
    <v-row>
      <v-col>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
    >
      <v-col
        cols="12"
        md="8"
        lg="6"
      >
        <v-switch
          v-model="showDenied"
          :label="$t('admin.labels.scheme.switches.denied')"
        ></v-switch>
        <scheme-admin-list :show-denied="showDenied"></scheme-admin-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import SchemeAdminList from './SchemeAdminListComponent.vue';

@Component({
  components: {
    SchemeAdminList,
  }
})
export default class SchemeAdminComponent extends Vue {
  showDenied = false;
}
</script>
