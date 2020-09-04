<template>
  <v-card>
    <v-tabs
      background-color="secondary"
    >
      <v-tab href="#role">
        {{ $t('admin.tabs.role') }}
      </v-tab>
      <v-tab href="#event">
        {{ $t('admin.tabs.event') }}
      </v-tab>

      <v-tab-item value="role">
        <role-admin></role-admin>
      </v-tab-item>
      <v-tab-item value="event">
        <event-admin></event-admin>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import RoleAdmin from '../components/admin/role/RoleAdminComponent.vue';
import EventAdmin from '../components/admin/event/EventAdminComponent.vue';

@Component({
  components: {
    RoleAdmin,
    EventAdmin
  }
})
export default class AdminApp extends Vue {}
</script>
