<template>
  <v-menu
    ref="menu"
    v-model="menu"
    :close-on-content-click="false"
    :return-value.sync="date"
    transition="scale-transition"
    offset-y
    min-width="290px"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
        v-model="date"
        :label="label"
        outlined
        prepend-icon="fas fa-calendar"
        readonly
        v-bind="attrs"
        v-on="on"
      ></v-text-field>
    </template>
    <v-date-picker
      :value="value"
      no-title
      scrollable
      :min="min"
      @change="onChangeDate"
    >
      <v-spacer></v-spacer>
      <v-btn
        text
        color="primary"
        @click="menu = false"
      >
        Cancel
      </v-btn>
      <v-btn
        text
        color="primary"
        @click="$refs.menu.save(date)"
      >
        OK
      </v-btn>
    </v-date-picker>
  </v-menu>
</template>

<script lang="ts">
import { Vue, Component, Prop, Watch } from 'vue-property-decorator';


@Component
export default class SchemeInputDatePickerComponent extends Vue {
  @Prop(String)
  label!: string;

  @Prop(String)
  min!: string;

  @Prop(String)
  value!: string;

  date = '';
  menu = false;

  created():void {
    this.date = this.value;
  }

  onChangeDate(val: string): void {
    this.date = val;
    this.$emit('input', val);
  }
}
</script>
