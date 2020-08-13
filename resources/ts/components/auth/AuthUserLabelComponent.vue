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
import { Vue, Component } from 'vue-property-decorator';
import { User } from '../../lib/models/auth';
import { apiModule } from '../../modules/api';

@Component
export default class AuthUserLabelComponent extends Vue {
  user: User|null = null;

  async mounted(): Promise<void> {
    try {
      this.user = await apiModule.getAuthMe();
    } catch (e) {
      console.error(e);
    }
  }
}
</script>
