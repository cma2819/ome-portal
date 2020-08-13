<template>
  <v-menu offset-y>
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        color="primary"
        v-bind="attrs"
        v-on="on"
      >
        {{ $t('layout.actions.menu') }}
      </v-btn>
    </template>
    <v-list>
      <v-list-item href="/logout">
        {{ $t('layout.actions.logout') }}
      </v-list-item>
    </v-list>
  </v-menu>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';

@Component
export default class AuthorizedMenuComponent extends Vue {
}
</script>
