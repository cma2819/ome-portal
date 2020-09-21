<template>
  <div>
    <v-row>
      <v-col>
        <video id="stream" muted="muted" />
      </v-col>
    </v-row>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

import flvJs from 'flv.js';
import Axios from 'axios';

@Component
export default class ScheduleStreamInternalApp extends Vue {
  @Prop(String)
  readonly streamUri!: string;

  mounted(): void {

    if (!flvJs.isSupported()) {
      return;
    }

    const videoElement = document.getElementById('stream') as HTMLMediaElement;
    const player = flvJs.createPlayer({
      type: 'flv',
      url: this.streamUri,
      isLive: true
    });
    player.attachMediaElement(videoElement);
    player.load();
    player.play();
  }
}
</script>
