<template>
  <v-container>
    <v-row align="end">
      <v-col
        cols="4"
        lg="2"
      >
        <v-checkbox
          v-model="allowed"
          :label="$t('admin.labels.twitter')"
          value="twitter"
          dense
          hide-details
        ></v-checkbox>
      </v-col>
      <v-col cols="auto">
        {{ $t('admin.descriptions.twitter') }}
      </v-col>
    </v-row>
    <v-row align="end">
      <v-col
        cols="4"
        lg="2"
      >
        <v-checkbox
          v-model="allowed"
          :label="$t('admin.labels.admin')"
          value="admin"
          dense
          hide-details
        ></v-checkbox>
      </v-col>
      <v-col cols="auto">
        {{ $t('admin.descriptions.admin') }}
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="12"
        align="right"
      >
        <v-btn
          color="info"
          :disabled="!changed"
          :loading="loading"
          @click="updateRole"
        >
          変更
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Emit, Prop } from 'vue-property-decorator';
import { Role } from '../../lib/models/role';
import { apiModule } from '../../modules/api';

@Component
export default class RoleAdminListRowComponent extends Vue {
  @Prop(Object)
  role!: Role;

  allowed: Array<string> = [];
  loading = false;

  created (): void {
    this.allowed = this.role.permissions;
  }

  get changed(): boolean {
    return this.allowed !== this.role.permissions;
  }

  @Emit()
  async updateRole(): Promise<void> {
    this.loading = true;
    try {
      await apiModule.putRole({
        id: this.role.id,
        permissions: this.allowed
      });
      this.loading = false;
    } catch (e) {
      console.error(e);
      this.loading = false;
    }
  }

}
</script>
