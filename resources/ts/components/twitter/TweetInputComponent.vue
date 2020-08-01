<template>
  <div>
    <v-row dense>
      <v-col
        cols="12"
        md="8"
        lg="6"
      >
        <v-textarea
          v-model="content"
          outlined
          auto-grow
          rows="3"
          clearable
          :messages="`${tweetParseResult.weightedLength}/280`"
          :color="tweetParseResult.valid ? 'black' : 'pink lighten-4'"
        ></v-textarea>
        <v-file-input
          v-model="file"
          :label="$t('twitter.labels.media')"
          :loading="loadingMedia"
          :disabled="loadingMedia || medias.length > 3"
          accept=".jpg,.jpeg,.png,.gif"
          @change="postMedia"
        ></v-file-input>
        <div>
          <v-chip
            v-for="media in medias"
            :key="media.mediaId"
            class="ma-2"
            close
            label
            @click:close="removeMedia(media.mediaId)"
          >
            {{ media.file.name }}
          </v-chip>
        </div>
      </v-col>
      <v-col
        cols-auto
        align-self="end"
      >
        <v-btn
          color="primary"
          :disabled="!tweetParseResult.valid"
          :loading="loading"
          @click="postTweet"
        >
          {{ $t('twitter.actions.post') }}
        </v-btn>
      </v-col>
    </v-row>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';

import twitterText, { ParsedTweet } from 'twitter-text';
import { apiModule } from '../../modules/api';
import { twitterModule } from '../../modules/twitter';
import { ApiError } from '../../lib/models/errors';

@Component
export default class TweetInputComponent extends Vue {
  hashtag = 'PGRF'
  content = '';
  file: File|null = null;
  medias: Array<{
    file: File,
    mediaId: number
  }> = [];

  loading = false;
  loadingMedia = false;

  get tweetParseResult(): ParsedTweet {
    return twitterText.parseTweet(`${this.content} #${this.hashtag}`);
  }

  mounted(): void {
    this.defaultInput();
  }

  defaultInput(): void {
    this.content = `#${this.hashtag}`;
    this.medias = [];
  }

  @Emit()
  async postTweet(): Promise<void> {
    this.loading = true;
    try {
      const mediaIds = this.medias.map((media) => {
        return media.mediaId;
      });
      const result = await apiModule.postTweet(this.content, mediaIds);
      twitterModule.addTweetToTimeline(result);
      this.defaultInput();
      this.loading = false;
    } catch (e) {
      alert((e as ApiError).message);
      console.error(e);
      this.loading = false;
    }
  }

  @Emit()
  async postMedia(): Promise<void> {
    if (this.file) {
    this.loadingMedia = true;
      try {
        const result = await apiModule.postMedia(this.file);
        this.medias.push({
          file: this.file,
          mediaId: result.mediaId,
        });
        this.file = null;
        this.loadingMedia = false;
      } catch (e) {
        alert((e as ApiError).message);
        console.error(e);
        this.loadingMedia = false;
      }
    }
  }

  @Emit()
  removeMedia(mediaId: number): void {
    this.medias = this.medias.filter((media) => {
      return media.mediaId !== mediaId;
    });
  }
}
</script>
