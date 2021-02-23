<template>
  <v-container>
    <v-row align="center">
      <v-col
        cols="12"
        md="6"
        lg="4"
      >
        <v-text-field
          v-model="username"
          :label="$t('mypage.profiles.labels.username')"
        ></v-text-field>
      </v-col>
      <v-col>
        <v-btn
          color="primary"
          :disabled="!profileChanged"
          :loading="loading"
          @click="submitEditProfile"
        >
          {{ $t('mypage.profiles.actions.edit') }}
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
    </v-row>
    <v-row>
      <v-col cols="auto">
        <v-subheader>
          {{ $t('mypage.profiles.labels.login') }}
        </v-subheader>
      </v-col>
      <v-col
        cols="10"
        md="6"
        lg="4"
      >
        <mypage-discord :discord="user.discord"></mypage-discord>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Prop, Emit } from 'vue-property-decorator';
import { User } from '../../lib/models/auth';
import { apiModule } from '../../modules/api';
import { authModule } from '../../modules/auth';

import MypageDiscord from './MypageDiscordComponent.vue';

@Component({
  components: {
    MypageDiscord,
  }
})
export default class MypageTabsComponent extends Vue {
  @Prop(Object)
  readonly user!: User;

  username = '';

  loading = false;

  created(): void {
    this.username = this.user.username;
  }

  get profileChanged(): boolean {
    if (this.user.username !== this.username) {
      return true;
    }

    return false;
  }

  @Emit()
  async submitEditProfile(): Promise<void> {
    this.loading = true;
    apiModule.updateAuthMe({username: this.username})
      .then(() => {
        authModule.authMe();
      })
      .catch((e) => {
        alert(this.$t('mypage.errors.profile'));
        console.error(e);
      })
      .finally(() => {
        this.loading = false;
      });
  }
}
</script>
