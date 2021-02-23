<template>
  <v-card>
    <v-tabs>
      <v-tab href="#profile">
        {{ $t('mypage.tabs.profile') }}
      </v-tab>
      <v-tab href="#streams">
        {{ $t('mypage.tabs.stream') }}
      </v-tab>
      <v-tab-item value="profile">
        <mypage-profile-edit :user="user"></mypage-profile-edit>
      </v-tab-item>
      <v-tab-item value="streams">
        <mypage-streams></mypage-streams>
      </v-tab-item>
    </v-tabs>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { User } from '../../lib/models/auth';

import MypageProfileEdit from './MypageProfileEditComponent.vue';
import MypageStreams from './MypageStreamsComponent.vue';

@Component({
  components: {
    MypageProfileEdit,
    MypageStreams,
  }
})
export default class MypageTabsComponent extends Vue {
  @Prop(Object)
  readonly user!: User;
}
</script>
