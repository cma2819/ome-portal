<template>
  <v-sheet
    elevation="2"
    class="pa-4"
  >
    <v-row dense>
      <v-col
        cols="12"
        md="8"
        lg="6"
      >
        <v-select
          v-model="hashtag"
          :items="slugs"
          :label="$t('twitter.labels.hashtag')"
          chips
          multiple
          clearable
          :loading="!initSlugs"
          :disabled="!initSlugs"
        ></v-select>
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
          accept=".jpg,.jpeg,.png"
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
          :disabled="!tweetParseResult.valid || !initSlugs"
          :loading="loading"
          @click="postTweet"
        >
          {{ $t('twitter.actions.post') }}
        </v-btn>
      </v-col>
    </v-row>
  </v-sheet>
</template>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';

import twitterText, { ParsedTweet } from 'twitter-text';
import { apiModule } from '../../modules/api';
import { twitterModule } from '../../modules/twitter';
import { ApiError } from '../../lib/models/errors';

@Component
export default class TweetInputComponent extends Vue {
  hashtag: Array<string> = []
  content = '';
  file: File|null = null;
  medias: Array<{
    file: File,
    mediaId: string
  }> = [];
  slugs: Array<string> = [];

  loading = false;
  loadingMedia = false;
  initSlugs = false;

  get tweetContent(): string {
    if (this.hashtag.length === 0) {
      return this.content;
    }

    const hashtagText = this.hashtag.map((tag) => {
      return `#${tag}`;
    }).join('\n');

    return `${this.content}\n${hashtagText}`;
  }

  get tweetParseResult(): ParsedTweet {
    return twitterText.parseTweet(this.tweetContent);
  }

  async created(): Promise<void> {

    const events = await apiModule.getActiveEvents();
    this.slugs = events.map((event) => {
      return event.slug;
    });
    this.slugs.push('OME');

    this.defaultInput();
    this.initSlugs = true;
  }

  defaultInput(): void {
    this.content = '';
    this.medias = [];
    this.hashtag = this.slugs.length > 0 ? [this.slugs[0]] : [];
  }

  @Emit()
  async postTweet(): Promise<void> {
    if (!this.tweetParseResult) {
      return;
    }

    this.loading = true;
    try {
      const mediaIds = this.medias.map((media) => {
        return media.mediaId;
      });
      const result = await apiModule.postTweet({text: this.tweetContent, mediaIds});
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
          mediaId: result.id,
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
  removeMedia(mediaId: string): void {
    this.medias = this.medias.filter((media) => {
      return media.mediaId !== mediaId;
    });
  }
}
</script>
