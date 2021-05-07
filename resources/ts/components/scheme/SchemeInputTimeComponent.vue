<template>
  <v-text-field
    :value="timeString"
    :label="label"
    outlined
    prepend-icon="fas fa-clock"
    :messages="$t('scheme.details.time')"
    :error-messages="error"
    :readonly="!editable"
    @blur="blurTimeInput"
    @focus="focusTimeInput"
  ></v-text-field>
</template>

<script lang="ts">
import { Vue, Component, Emit, Prop, Watch } from 'vue-property-decorator';


@Component
export default class SchemeInputTimeComponent extends Vue {
  @Prop(String)
  readonly label!: string;

  @Prop(String)
  readonly value!: string;

  @Prop(Boolean)
  readonly editable!: boolean

  time = '';
  timeString = '';

  error: string|null = null;

  created():void {
    this.timeString = this.value;
  }

  @Emit()
  blurTimeInput(e: { target: { value : string; }; }): void {
    if (!this.editable) {
      return;
    }
    const time = e.target.value;
    if (!time) {
      return;
    }
    const timeRegExp = /^[0-9]{4}$/;
    if (timeRegExp.test(time)) {
      this.time = time;

      const hour = time.slice(0, 2);
      const minute = time.slice(2,4);

      if (!this._isHour(hour)) {
        this.error = this.$t('scheme.errors.time.hour').toString();
      }

      if (!this._isMinute(minute)) {
        this.error = this.$t('scheme.errors.time.minute').toString();
      }

      this.timeString = `${hour}:${minute}`;
    } else {
      this.error = this.$t('scheme.errors.time.format').toString();
    }
  }

  private _isHour(hour: string): boolean {
    return !((parseInt(hour) < 0) || (parseInt(hour) > 23))
  }

  private _isMinute(minute: string): boolean {
    return !((parseInt(minute) < 0) || (parseInt(minute) > 60))
  }

  @Emit()
  focusTimeInput(): void {
    if (!this.editable) {
      return;
    }
    this.error = null;
    this.timeString = this.timeString.replace(':', '');
  }

  @Watch('timeString')
  onChangeTime(val: string): void {
    this.$emit('input', val);
  }
}
</script>
