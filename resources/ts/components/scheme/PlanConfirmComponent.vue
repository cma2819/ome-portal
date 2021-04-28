<template>
  <div>
    <v-card>
      <v-card-title>応募ありがとうございました。</v-card-title>
      <v-card-text>
        <div class="text--primary">
          <p>
            今後のイベント企画の参考にさせていただきます。
          </p>
          <p>
            また、イベント実現の際には、運営からご連絡させていただく場合がございます。
          </p>
        </div>
      </v-card-text>
    </v-card>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class PlanConfimComponent extends Vue {}
</script>
