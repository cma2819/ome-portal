<template>
  <v-row
    justify="space-around"
  >
    <v-col
      cols="12"
      md="10"
      lg="8"
    >
      <div>
        <v-btn
          color="primary"
          dark
          :to="{ name: 'index' }"
        >
          <v-icon>fas fa-caret-left</v-icon>
        </v-btn>
      </div>
      <div class="pa-2">
        <scheme-input></scheme-input>
      </div>
    </v-col>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import SchemeInput from './SchemeInputComponent.vue';

@Component({
  components: {
    SchemeInput,
  }
})
export default class SchemeApplyComponent extends Vue {}
</script>
