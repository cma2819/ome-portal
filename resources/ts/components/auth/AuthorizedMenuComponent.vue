<template>
  <v-menu offset-y>
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        color="primary"
        outlined
        fab
        v-bind="attrs"
        v-on="on"
      >
        <v-avatar>
          <img
            :src="user.thumbnail"
            :alt="user.username"
          >
        </v-avatar>
      </v-btn>
    </template>
    <v-list>
      <v-list-item href="/">
        {{ $t('layout.actions.top') }}
      </v-list-item>

      <v-list-item href="/mypage">
        {{ $t('layout.actions.mypage') }}
      </v-list-item>

      <v-divider></v-divider>

      <v-list-item href="/events">
        {{ $t('layout.actions.event') }}
      </v-list-item>

      <v-list-item href="/schemes">
        {{ $t('layout.actions.scheme') }}
      </v-list-item>

      <v-divider></v-divider>

      <v-list-item
        v-if="canTwitter"
        href="/twitter"
      >
        {{ $t('layout.actions.twitter') }}
      </v-list-item>
      <v-list-item
        v-if="canAdmin"
        href="/admin"
      >
        {{ $t('layout.actions.admin') }}
      </v-list-item>

      <v-divider></v-divider>

      <v-list-item href="/logout">
        {{ $t('layout.actions.logout') }}
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { Permissions, User } from '../..//lib/models/auth';

@Component
export default class AuthorizedMenuComponent extends Vue {
  @Prop(Object)
  user!: User;

  get permissions(): Permissions {
    return this.user.permissions;
  }

  get canTwitter(): boolean {
    return this.permissions.includes('twitter');
  }

  get canAdmin(): boolean {
    return this.permissions.includes('admin');
  }
}
</script>
