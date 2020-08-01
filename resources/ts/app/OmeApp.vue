<template>
  <v-app>
    <v-app-bar
      app
      color="primary"
      dark
    >
      <v-toolbar-title>OME Portal</v-toolbar-title>
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

import { apiModule } from '../modules/api';

@Component
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
