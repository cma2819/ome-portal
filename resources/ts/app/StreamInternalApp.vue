<template>
  <div>
    <h3>{{ streamId }}の配信視聴ページ</h3>
    <v-row justify="center">
      <v-col cols="12" md="8" lg="6">
        <video
          id="stream"
          muted="muted"
          controls
        >Your browser does not support HTML5 video.</video>
      </v-col>
    </v-row>
  </div>
</template>

<style>
video {
  width: 100%;
}
</style>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import flvJs from 'flv.js';

@Component
export default class ScheduleStreamInternalApp extends Vue {

  @Prop(String)
  readonly streamId!: string;

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
