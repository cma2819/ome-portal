<template>
  <div>
    <fade-transition>
      <router-view></router-view>
    </fade-transition>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import FadeTransition from '../components/FadeTransitionComponent.vue';

@Component({
  components: {
    FadeTransition,
  }
})
export default class ScheduleApp extends Vue {}
</script>
