<template>
  <v-btn
    :href="loginUrl"
    outlined
  >
    {{ $t('layout.actions.login') }}
  </v-btn>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class AuthLoginButtonComponent extends Vue {
  @Prop(String)
  loginUrl!: string;
}
</script>
