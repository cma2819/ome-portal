<template>
  <fade-transition>
    <v-card v-if="user">
      <v-card-title>
        <v-row align="center">
          <v-col cols="auto">
            <v-avatar>
              <img
                :src="user.thumbnail"
                :alt="user.username"
              >
            </v-avatar>
          </v-col>
          <v-col>
            {{ user.username }}
          </v-col>
        </v-row>
      </v-card-title>
      <v-divider></v-divider>
      <mypage-tabs :user="user"></mypage-tabs>
    </v-card>
    <linear-loading v-else></linear-loading>
  </fade-transition>
</template>

<script lang="ts">
import { Vue, Component, Prop, Provide } from 'vue-property-decorator';
import { User } from '../lib/models/auth';
import { authModule } from '../modules/auth';

import MypageTabs from '../components/mypage/MypageTabsComponent.vue';
import LinearLoading from '../components/LinearLoadingComponent.vue';
import FadeTransition from '../components/FadeTransitionComponent.vue';

@Component({
  components: {
    MypageTabs,
    LinearLoading,
    FadeTransition,
  }
})
export default class MypageApp extends Vue {
  @Prop(String)
  readonly twitchAuthUrl!: string;

  @Provide('twitch-auth-url') provideTwitchAuthUrl = this.twitchAuthUrl;

  get user(): User|null {
    return authModule.authUser;
  }
}
</script>
