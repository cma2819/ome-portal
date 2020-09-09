<template>
  <div>
    <recently-event></recently-event>
    <v-card>
      <v-card-title>OME Portalへようこそ！</v-card-title>
      <v-card-text>本サイトは「Online Marathon Eventers」によるオンラインイベントの管理ポータルサイトです。</v-card-text>
      <v-card-title>使い方</v-card-title>
      <v-card-text>
        <div class="text--primary">
          <p>未ログインの方は、右上の「ログイン」からDiscordアカウントでログインしてください。（Discordアカウント以外でのログインはサポートしません）</p>
          <p>ログイン済みの方は、右上のメニューから各機能を利用することができます。各機能はOMEサーバ内のアカウントの権限をもとに管理されています。</p>
        </div>
      </v-card-text>
      <v-card-title>実装予定の機能</v-card-title>
      <v-card-text>
        <ul>
          <li>開催予定／開催中のイベントをトップに表示（Oengus連携）</li>
          <li>イベント関係者の配信チェッカー機能</li>
          <li>イベント申請フォーム及び申請情報管理機能</li>
          <li>イベントカレンダー</li>
        </ul>
      </v-card-text>
      <v-card-title>要望・バグ報告</v-card-title>
      <v-card-text>
        本サイトに関わる要望やバグ報告については、
        <a href="https://github.com/cma2819/ome-portal/issues">GitHubのissue</a>にてご連絡ください。
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import RecentlyEvent from '../components/schedule/RecentlyEventComponent.vue';

@Component({
  components: {
    RecentlyEvent
  }
})
export default class TopApp extends Vue { }
</script>
