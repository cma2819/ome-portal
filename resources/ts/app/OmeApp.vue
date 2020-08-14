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

      <v-spacer></v-spacer>

      <template v-if="bearer">
        <auth-user-label :user="user"></auth-user-label>
        <authorized-menu :permissions="user.permissions"></authorized-menu>
      </template>
      <auth-login-button
        v-else
        :login-url="loginUrl"
      ></auth-login-button>
    </v-app-bar>

    <v-main>
      <slot />
    </v-main>
    <v-footer
      color="primary"
      app
    >
      <span class="white--text">&copy; {{ new Date().getFullYear() }} Online Marathon Eventers</span>
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
export default class TwitterApp extends Vue {
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
