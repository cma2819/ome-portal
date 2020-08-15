<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <role-admin-list></role-admin-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import RoleAdminList from './RoleAdminListComponent.vue';

@Component({
  components: {
    RoleAdminList
  }
})
export default class RoleAdminComponent extends Vue {}
</script>
