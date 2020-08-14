<template>
  <div
    v-if="user"
    class="mr-2"
  >
    ようこそ, {{ user.username }}さん
  </div>
  <v-progress-circular
    v-else
    indeterminate
    color="white"
  ></v-progress-circular>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { User } from '../../lib/models/auth';

@Component
export default class AuthUserLabelComponent extends Vue {
  @Prop(Object)
  user!: User;
}
</script>
