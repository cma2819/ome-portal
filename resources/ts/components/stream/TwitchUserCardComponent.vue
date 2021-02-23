<template>
  <v-card color="twitch">
    <v-card-title class="white--text">
      <v-icon
        left
        class="white--text"
      >
        fab fa-twitch
      </v-icon>
      {{ twitch.username }}
    </v-card-title>
    <v-card-actions>
      <v-btn
        color="white"
        icon
        fab
        :href="`https://www.twitch.tv/${twitch.username}`"
        target="_blank"
      >
        <v-icon>
          fas fa-external-link-alt
        </v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { TwitchUser } from '../../lib/models/stream';

@Component
export default class LinearLoadingComponent extends Vue {
  @Prop(Object)
  readonly twitch!: TwitchUser;
}
</script>
