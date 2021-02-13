<template>
  <v-data-table
    :headers="headers"
    :items="users"
    sort-by="id"
    :items-per-page="Infinity"
    hide-default-footer
    :loading="users.length === 0"
  >
    <template v-slot:[`item.actions`]>
      <v-btn
        color="primary"
        disabled
      >
        Oengus
      </v-btn>
    </template>
    <template v-slot:footer>
      <v-row
        dense
        justify="center"
      >
        <v-col cols="auto">
          <v-btn
            icon
            :disabled="!prev"
            @click="loadPrev"
          >
            <v-icon>
              fas fa-caret-left
            </v-icon>
          </v-btn>
          <v-btn
            icon
            :disabled="!next"
            @click="loadNext"
          >
            <v-icon>
              fas fa-caret-right
            </v-icon>
          </v-btn>
        </v-col>
      </v-row>
    </template>
  </v-data-table>
</template>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';
import { DataTableHeader } from 'vuetify';
import { User } from '../../../lib/models/user';
import { apiModule } from '../../../modules/api';

@Component
export default class UsersAdminTableComponent extends Vue {
  prev: number|null = null;
  current = 0;
  next: number|null = null;
  users: Array<User> = [];

  created(): void {
    this.loadUsers(0);
  }

  @Emit()
  loadPrev(): void {
    if (!this.prev) {
      return;
    }

    this.loadUsers(this.prev);
  }

  @Emit()
  loadNext(): void {
    if (!this.next) {
      return;
    }

    this.loadUsers(this.next);
  }

  async loadUsers(page: number): Promise<void> {
    const response = await apiModule.getUsers(page);

    this.prev = response.prev;
    this.current = response.current;
    this.next = response.next;
    this.users = response.data;
  }

  get headers(): Array<DataTableHeader> {
    return [
      {
        text: this.$t('admin.users.labels.id').toString(),
        value: 'id',
      },
      {
        text: this.$t('admin.users.labels.username').toString(),
        value: 'username',
      },
      {
        text: this.$t('admin.users.labels.discord').toString(),
        value: 'discord.id',
      },
      {
        text: this.$t('admin.users.labels.actions').toString(),
        value: 'actions',
        sortable: false
      },
    ];
  }
}
</script>
