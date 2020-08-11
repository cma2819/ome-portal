<template>
  <v-btn color="primary">
    {{ $t('layout.actions.menu') }}
  </v-btn>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class AuthorizedMenuComponent extends Vue {
}
</script>
