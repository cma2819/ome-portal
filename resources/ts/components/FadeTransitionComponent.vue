<template>
  <transition
    name="fade"
    mode="out-in"
  >
    <slot />
  </transition>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: all .2s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class FadeTransitionComponent extends Vue {}
</script>
