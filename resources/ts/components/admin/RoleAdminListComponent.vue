<template>
  <v-expansion-panels>
    <v-expansion-panel
      v-for="role in roles"
      :key="role.id"
      :style="{
        borderLeft: `4px solid ${$vuetify.theme.themes.light.secondary}`
      }"
    >
      <v-expansion-panel-header>{{ role.name }}</v-expansion-panel-header>
      <v-expansion-panel-content>
        <role-admin-list-row :role="role"></role-admin-list-row>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import RoleAdminListRow from './RoleAdminListRowComponent.vue';
import { Role } from '../../lib/models/role';
import { apiModule } from '../../modules/api';

@Component({
  components: {
    RoleAdminListRow
  }
})
export default class RoleAdminListComponent extends Vue {
  roles: Array<Role> = [];

  async created (): Promise<void> {
    this.roles = await apiModule.getRoles();
  }
}
</script>
