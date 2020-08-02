<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-row>
          <h3>{{ $t('twitter.labels.input') }}</h3>
        </v-row>
        <v-row>
          <v-col cols="12">
            <tweet-input></tweet-input>
          </v-col>
        </v-row>
      </v-col>
      <v-col
        cols="12"
      >
        <v-row>
          <v-col
            cols="9"
            md="8"
            lg="6"
          >
            <h3>{{ $t('twitter.labels.list') }}</h3>
          </v-col>
          <v-col
            cols="3"
            align-self="center"
          >
            <v-btn
              color="info"
              @click="updateTimeline"
            >
              {{ $t('twitter.actions.update') }}
            </v-btn>
          </v-col>
        </v-row>
        <v-row>
          <v-col
            cols="12"
            md="8"
            lg="6"
          >
            <transition-group name="timeline">
              <tweet-card
                v-for="tweet in twitter.timeline"
                :key="tweet.id"
                :tweet="tweet"
              ></tweet-card>
            </transition-group>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<style scoped>
.timeline-enter-active, .timeline-leave-active {
  transition: all 1s;
}

.timeline-enter, .timeline-leave-to {
  opacity: 0;
  transform: translateX(25px);
}
</style>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';
import TweetCard from '../components/twitter/TweetCardComponent.vue';
import TweetInput from '../components/twitter/TweetInputComponent.vue';

import { twitterModule } from '../modules/twitter';

@Component({
  components: {
    TweetInput,
    TweetCard
  }
})
export default class TwitterApp extends Vue {
  twitter = twitterModule;

  async mounted(): Promise<void> {
    await twitterModule.updateTimeline();
  }

  @Emit()
  updateTimeline(): void {
    twitterModule.updateTimeline();
  }
}
</script>
