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
      <v-tab href="#scheme">
        {{ $t('admin.tabs.scheme') }}
      </v-tab>
      <v-tab href="#plan">
        {{ $t('admin.tabs.plan') }}
      </v-tab>
      <v-tab href="#users">
        {{ $t('admin.tabs.users') }}
      </v-tab>

      <v-tab-item value="role">
        <role-admin></role-admin>
      </v-tab-item>
      <v-tab-item value="event">
        <event-admin></event-admin>
      </v-tab-item>
      <v-tab-item value="scheme">
        <scheme-admin></scheme-admin>
      </v-tab-item>
      <v-tab-item value="plan">
        <plan-admin></plan-admin>
      </v-tab-item>
      <v-tab-item value="users">
        <users-admin></users-admin>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import RoleAdmin from '../components/admin/role/RoleAdminComponent.vue';
import EventAdmin from '../components/admin/event/EventAdminComponent.vue';
import SchemeAdmin from '../components/admin/scheme/SchemeAdminComponent.vue';
import PlanAdmin from '../components/admin/plan/PlanAdminComponent.vue';
import UsersAdmin from '../components/admin/users/UsersAdminComponent.vue';

@Component({
  components: {
    RoleAdmin,
    EventAdmin,
    SchemeAdmin,
    UsersAdmin,
    PlanAdmin,
  }
})
export default class AdminApp extends Vue {}
</script>
