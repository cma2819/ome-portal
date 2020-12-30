<template>
  <v-row
    justify="space-around"
  >
    <v-col
      cols="12"
      md="10"
      lg="8"
    >
      <div>
        <v-card>
          <v-card-title>イベント応募について</v-card-title>
          <v-card-text>
            <div class="text--primary">
              <p>Online Marathon Eventesにて開催するイベントを応募することができます。</p>
              <p>採用されたイベントについては、<strong>原則Online Marathon EventersのTwitchチャンネルでの配信</strong>を行います。他の配信先をご希望の場合は一度ご相談ください。</p>
              <p>
                Online Marathon Eventersは、応募いただいたイベントに対してのサポートをさせていただきます。また、企画案のみでご応募いただき、運営を全て一任していただくことも可能です。
                その場合、イベント開催の際には応募者の方をご紹介させていただきます。
              </p>
              <p>
                イベント内容やスケジュール、その他の事情によって、全てのイベントを実現させることができないことをご了承ください。
                実現可否についてはできるだけ早くご回答させていただきますが、開催スケジュールに余裕を持ったご応募をお願いいたします。
              </p>
            </div>
          </v-card-text>
        </v-card>
        <div class="pa-2 text-right">
          <v-btn
            color="primary"
            dark
            :to="{ name: 'apply' }"
            :disabled="!authenticated"
          >
            {{ $t('scheme.links.apply') }}
          </v-btn>
        </div>
        <transition name="scheme-list">
          <div
            v-if="schemes.length !== 0"
            class="py-2"
          >
            <scheme-list
              :schemes="schemes"
            ></scheme-list>
          </div>
        </transition>
        <div
          v-if="!authenticated"
          class="pa-2"
        >
          <v-alert
            type="info"
          >
            {{ $t('scheme.messages.auth') }}
          </v-alert>
        </div>
      </div>
    </v-col>
  </v-row>
</template>

<style scoped>
.scheme-list-enter-active {
  transition: .5s all;
}

.scheme-list-enter {
  opacity: 0;
  transform: translateX(10px);
}
</style>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import { EventScheme } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

import SchemeList from './SchemeListComponent.vue';

@Component({
  components: {
    SchemeList,
  }
})
export default class SchemeIndexComponent extends Vue {

  schemes: Array<EventScheme> = [];

  get authenticated(): boolean {
    return apiModule.isAuthenticated;
  }

  async mounted():Promise<void> {
    try {
      const user = await apiModule.getAuthMe();
      this.schemes = await apiModule.getSchemes({
        planner: user.id,
      });
    } catch (e) {
      // do nothing
    }
  }
}
</script>
