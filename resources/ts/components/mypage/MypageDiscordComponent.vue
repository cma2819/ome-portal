<template>
  <v-text-field
    hide-details
    readonly
    label="Discord"
    :value="discordUsername"
    color="discord"
  ></v-text-field>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { DiscordProfile } from '../../lib/models/auth';

@Component
export default class MypageDiscordComponent extends Vue {
  @Prop(Object)
  readonly discord!: DiscordProfile;

  get discordUsername(): string {
    return `${this.discord.username}#${this.discord.discriminator}`;
  }
}
</script>
