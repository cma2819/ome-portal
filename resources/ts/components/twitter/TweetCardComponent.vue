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
  </v-card>
</template>

<style scoped>
.text {
  color: black;
  font-size: 1rem;
}
</style>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { Tweet } from '../../lib/models/twitter';

@Component
export default class TweetCardComponent extends Vue {
  @Prop(Object)
  readonly tweet!: Tweet;

  get formattedCreatedAt(): string {
    const createdAtDate = new Date(Date.parse(this.tweet.createdAt));
    return `${createdAtDate.getFullYear()}/${createdAtDate.getMonth() + 1}/${createdAtDate.getDate()}`
      + ` ${createdAtDate.getHours()}:${createdAtDate.getMinutes()}:${createdAtDate.getSeconds()}`;
  }
}
</script>
