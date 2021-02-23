<template>
  <div>
    <v-btn
      class="ma-1"
      color="twitch"
      block
      dark
      :href="twitchAuthUrl"
    >
      <v-icon
        left
      >
        fab fa-twitch
      </v-icon>
      Twitchチャンネルを追加
    </v-btn>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Inject } from 'vue-property-decorator';

@Component
export default class MypageStreamsAuthorizeComponent extends Vue {
  @Inject('twitch-auth-url') readonly twitchAuthUrl!: string;
}
</script>
