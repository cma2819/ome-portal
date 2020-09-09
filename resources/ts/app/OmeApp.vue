<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <v-toolbar-title>
        OME Portal
      </v-toolbar-title>

      <div class="mx-2">
        <v-btn text href="/schedules">
          {{ $t('layout.actions.schedule') }}
        </v-btn>
      </div>

      <v-spacer></v-spacer>

      <template v-if="bearer && user">
        <auth-user-label :user="user"></auth-user-label>
        <authorized-menu :permissions="user.permissions"></authorized-menu>
      </template>
      <auth-login-button
        v-else-if="!bearer"
        :login-url="loginUrl"
      ></auth-login-button>
      <v-progress-circular
        v-else
        indeterminate
        color="white"
      ></v-progress-circular>
    </v-app-bar>

    <v-main>
      <slot />
    </v-main>
    <v-footer
      color="primary"
      app
    >
      <span class="white--text">&copy; {{ new Date().getFullYear() }} Online Marathon Eventers</span>
      <v-spacer></v-spacer>
      <v-btn
        icon
        color="white"
        target="_blank"
        href="https://github.com/cma2819/ome-portal"
      >
        <v-icon>fab fa-github</v-icon>
      </v-btn>
      <v-btn
        icon
        color="white"
        target="_blank"
        href="https://twitter.com/ome_speedrun"
      >
        <v-icon>fab fa-twitter</v-icon>
      </v-btn>
      <v-btn
        icon
        color="white"
        target="_blank"
        href="https://twitch.tv/ome_speedrun"
      >
        <v-icon>fab fa-twitch</v-icon>
      </v-btn>
    </v-footer>
  </v-app>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import AuthLoginButton from '../components/auth/AuthLoginButtonComponent.vue';
import AuthorizedMenu from '../components/auth/AuthorizedMenuComponent.vue';
import AuthUserLabel from '../components/auth/AuthUserLabelComponent.vue';

import { apiModule } from '../modules/api';
import { User } from '../lib/models/auth';

@Component({
  components: {
    AuthorizedMenu,
    AuthLoginButton,
    AuthUserLabel,
  }
})
export default class OmeApp extends Vue {
  @Prop(String)
  readonly apiHost!: string;
  @Prop(String)
  readonly bearer!: string;
  @Prop(String)
  readonly loginUrl!: string;

  user: User|null = null;

  async created(): Promise<void> {
    apiModule.updateHost(this.apiHost);
    if (this.bearer) {
      apiModule.updateBearerToken(this.bearer);

      try {
        this.user = await apiModule.getAuthMe();
      } catch (e) {
        console.error(e);
      }
    }
  }
}
</script>
