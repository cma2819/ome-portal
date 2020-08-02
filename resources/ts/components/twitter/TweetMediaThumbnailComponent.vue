<template>
  <div class="d-flex ma-2">
    <v-img
      :src="media.mediaUrl"
      aspect-ratio="1"
      height="75"
      width="75"
      contain
    >
    </v-img>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { TwitterMedia } from '../../lib/models/twitter';

@Component
export default class TweetMediaThumbnailComponent extends Vue {
  @Prop(Object)
  readonly media!: TwitterMedia;
}
</script>
