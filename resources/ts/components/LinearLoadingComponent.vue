<template>
  <v-container>
    <v-row justify="center">
      <v-col cols="auto">
        <v-subheader>
          Loading...
        </v-subheader>
      </v-col>
    </v-row>
    <v-row justify="center">
      <v-col
        cols="12"
        md="6"
        lg="4"
      >
        <v-progress-linear
          indeterminate
          rounded
          height="6"
        ></v-progress-linear>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component
export default class LinearLoadingComponent extends Vue {}
</script>
