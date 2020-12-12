<template>
  <div>
    <v-card>
      <v-card-title>応募ありがとうございました。</v-card-title>
      <v-card-text>
        <div class="text--primary">
          <p>
            イベント開催の可否に関わらず、Online Marathon Eventersからご連絡させていただきます。
          </p>
          <p>
            ご連絡まではイベントの開催日時等によってお時間をいただく場合があります。しばらくお待ちください。
          </p>
        </div>
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class SchemeConfimComponent extends Vue {}
</script>
