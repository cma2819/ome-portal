<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="6"
        lg="4"
      >
        <event-admin-import></event-admin-import>
      </v-col>
      <v-col>
        <event-admin-list></event-admin-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import EventAdminImport from './EventAdminImportComponent.vue';
import EventAdminList from './EventAdminListComponent.vue';

@Component({
  components: {
    EventAdminImport,
    EventAdminList,
  }
})
export default class EventAdminComponent extends Vue {}
</script>
