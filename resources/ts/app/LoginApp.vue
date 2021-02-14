<template>
  <v-container>
    <v-row>
      <v-col>
        <v-alert type="info">
          ログインが必要なページです。画面右上のボタンからログインしてください。
        </v-alert>
      </v-col>
    </v-row>
  </v-container>
</template>

<style>
video {
  width: 100%;
}
</style>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class LoginApp extends Vue {}
</script>
