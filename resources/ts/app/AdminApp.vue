<template>
  <v-card>
    <v-tabs
      background-color="secondary"
    >
      <v-tab href="#role">
        {{ $t('admin.tabs.role') }}
      </v-tab>

      <v-tab-item value="role">
        <role-admin></role-admin>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import RoleAdmin from '../components/admin/RoleAdminComponent.vue';

@Component({
  components: {
    RoleAdmin
  }
})
export default class AdminApp extends Vue {}
</script>
