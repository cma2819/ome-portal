<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <v-toolbar-title>OME Portal</v-toolbar-title>

      <v-spacer></v-spacer>

      <template v-if="bearer">
        <div class="mr-2">
          ようこそ, ユーザーさん
        </div>
        <authorized-menu></authorized-menu>
      </template>
      <auth-login-button v-else></auth-login-button>
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

import { apiModule } from '../modules/api';

@Component({
  components: {
    AuthorizedMenu,
    AuthLoginButton
  }
})
export default class TwitterApp extends Vue {
  @Prop(String)
  readonly apiHost!: string;
  @Prop(String)
  readonly bearer: string|undefined;

  created(): void {
    apiModule.updateHost(this.apiHost);
    if (this.bearer) {
      apiModule.updateBearerToken(this.bearer);
    }
  }
}
</script>
