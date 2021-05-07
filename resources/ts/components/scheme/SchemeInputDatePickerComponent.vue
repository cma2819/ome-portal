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
        placeholder="click for picking date."
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
      :readonly="!editable"
      @change="onChangeDate"
    >
      <v-spacer></v-spacer>
      <v-btn
        v-if="editable"
        text
        color="primary"
        @click="menu = false"
      >
        Cancel
      </v-btn>
      <v-btn
        v-if="editable"
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
import { Vue, Component, Prop } from 'vue-property-decorator';


@Component
export default class SchemeInputDatePickerComponent extends Vue {
  @Prop(String)
  readonly label!: string;

  @Prop(String)
  readonly min!: string;

  @Prop(String)
  readonly value!: string;

  @Prop(Boolean)
  readonly editable!: boolean

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
