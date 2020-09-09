<template>
  <div>
    <transition name="app-transition" mode="in-out">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style scoped>
.app-transition-enter-active, .app-transition-leave-active {
  transition: all 1s;
}

.app-transition-enter, .app-transition-leave-to {
  opacity: 0;
}
</style>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class ScheduleApp extends Vue {}
</script>
