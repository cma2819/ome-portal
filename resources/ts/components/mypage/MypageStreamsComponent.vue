<template>
  <v-container>
    <v-row>
      <v-col
        v-for="tw in twitch"
        :key="tw.id"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <twitch-user-card :twitch="tw"></twitch-user-card>
      </v-col>
      <v-col
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <mypage-streams-authorize></mypage-streams-authorize>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import { TwitchUser } from '../../lib/models/stream';
import { authModule } from '../../modules/auth';

import MypageStreamsAuthorize from './MypageStreamsAuthorizeComponent.vue';
import TwitchUserCard from '../stream/TwitchUserCardComponent.vue';

@Component({
  components: {
    MypageStreamsAuthorize,
    TwitchUserCard,
  }
})
export default class MypageStreamsComponent extends Vue {
  get twitch(): Array<TwitchUser> {
    return (authModule.authUser?.channels.twitch || []);
  }
}
</script>
