<template>
  <v-container>
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
        </div>
      </v-col>
    </v-row>
    <v-row justify="space-around">
      <v-col
        cols="12"
        md="10"
        lg="8"
      >
        <div>
          <v-card
            color="primary"
          >
            <v-list
              subheader
              three-line
            >
              <v-list-item
                color="primary"
                :to="{ name: 'apply' }"
                :disabled="!authenticated"
              >
                <v-list-item-avatar>
                  <v-icon>
                    far fa-hand-paper
                  </v-icon>
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title>
                    イベント運営応募
                  </v-list-item-title>
                  <v-list-item-subtitle>
                    運営として、OMEチャンネルで開催したいイベントを応募します。
                    OMEからは、走者やコメンテータの応募や配信・運営に関わる技術的なサポートが可能です。
                  </v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-list-item
                color="primary"
                :to="{ name: 'plan-apply' }"
                :disabled="!authenticated"
              >
                <v-list-item-avatar>
                  <v-icon>
                    far fa-comment-dots
                  </v-icon>
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title>
                    イベント企画案応募
                  </v-list-item-title>
                  <v-list-item-subtitle>
                    OMEで開催してほしいイベントの企画案を応募します。
                    イベントの運営はOMEとなりますが、開催されるかどうかはOMEでの判断となります。
                  </v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card>

          <div class="py-2">
            <scheme-list></scheme-list>
          </div>
          <div class="py-2">
            <plan-list></plan-list>
          </div>

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
  </v-container>
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
import PlanList from './PlanListComponent.vue';

@Component({
  components: {
    SchemeList,
    PlanList,
  }
})
export default class SchemeIndexComponent extends Vue {

  schemes: Array<EventScheme>|null = null;

  get authenticated(): boolean {
    return apiModule.isAuthenticated;
  }
}
</script>
