<template>
  <v-card class="my-2">
    <v-card-text>
      <div class="created-date">
        {{ formattedCreatedAt }}
      </div>
      <div class="text">
        {{ tweet.text }}
      </div>
    </v-card-text>
    <v-card-actions>
      <v-list-item>
        <tweet-media-thumbnail
          v-for="media in tweet.medias"
          :key="media.id"
          :media="media"
        ></tweet-media-thumbnail>
      </v-list-item>
      <v-row
        align="end"
        justify="end"
      >
        <v-col>
          <v-btn
            color="error"
            :loading="loading"
            @click="deleteTweet"
          >
            {{ $t('twitter.actions.delete') }}
          </v-btn>
        </v-col>
      </v-row>
    </v-card-actions>
  </v-card>
</template>

<style scoped>
.text {
  color: black;
  font-size: 1rem;
}
</style>

<script lang="ts">
import { Vue, Component, Prop, Emit } from 'vue-property-decorator';
import { Tweet } from '../../lib/models/twitter';

import TweetMediaThumbnail from './TweetMediaThumbnailComponent.vue';
import { apiModule } from '../../modules/api';
import { twitterModule } from '../../modules/twitter';
import { ApiError } from '../../lib/models/errors';

@Component({
  components: {
    TweetMediaThumbnail
  }
})
export default class TweetCardComponent extends Vue {
  @Prop(Object)
  readonly tweet!: Tweet;

  loading = false;

  get formattedCreatedAt(): string {
    const createdAtDate = new Date(Date.parse(this.tweet.createdAt));
    const month = (createdAtDate.getMonth() + 1).toString().padStart(2, '0');
    const date = createdAtDate.getDate().toString().padStart(2, '0');
    const hours = createdAtDate.getHours().toString().padStart(2, '0');
    const minutes = createdAtDate.getMinutes().toString().padStart(2, '0');
    const seconds = createdAtDate.getSeconds().toString().padStart(2, '0');
    return `${createdAtDate.getFullYear()}/${month}/${date} ${hours}:${minutes}:${seconds}`;
  }

  @Emit()
  async deleteTweet(): Promise<void> {
    try {
      this.loading = true;
      await apiModule.deleteTweet(this.tweet.id);
      twitterModule.removeTweetFromTimeline(this.tweet.id);
    } catch (e) {
      alert((e as ApiError).message);
      console.error(e);
      this.loading = false;
    }
  }
}
</script>
