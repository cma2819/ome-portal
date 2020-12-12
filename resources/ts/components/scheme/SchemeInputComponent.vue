<template>
  <v-sheet
    key="input"
    class="pa-4"
  >
    <v-row
      justify="space-around"
      dense
    >
      <v-col>
        <small class="red--text">
          {{ $t('generals.required') }}
        </small>
        <v-text-field
          v-model="name"
          solo
          :label="$t('scheme.labels.name')"
          :messages="$t('scheme.details.name')"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
      dense
    >
      <v-col>
        <v-row>
          <v-col
            cols="12"
            md="6"
            lg="4"
          >
            <scheme-input-date-picker
              v-model="startAt.date"
              :label="$t('scheme.labels.start.date')"
            ></scheme-input-date-picker>
          </v-col>
          <v-col
            cols="12"
            md="6"
            lg="4"
          >
            <scheme-input-time
              v-model="startAt.time"
              :label="$t('scheme.labels.start.time')"
            ></scheme-input-time>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
      dense
    >
      <v-col>
        <v-row>
          <v-col
            cols="12"
            md="6"
            lg="4"
          >
            <scheme-input-date-picker
              v-model="endAt.date"
              :label="$t('scheme.labels.end.date')"
              :min="startAt.date"
            ></scheme-input-date-picker>
          </v-col>
          <v-col
            cols="12"
            md="6"
            lg="4"
          >
            <scheme-input-time
              v-model="endAt.time"
              :label="$t('scheme.labels.end.time')"
            ></scheme-input-time>
          </v-col>
        </v-row>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
    >
      <v-col>
        <small class="red--text">
          {{ $t('generals.required') }}
        </small>
        <v-textarea
          v-model="explanation"
          solo
          name="input-7-4"
          :label="$t('scheme.labels.explanation')"
          :messages="$t('scheme.details.explanation')"
          auto-grow
        ></v-textarea>
      </v-col>
    </v-row>
    <v-row
      justify="space-around"
    >
      <v-col class="text-right">
        <v-btn
          color="primary"
          :loading="loading"
          :disabled="!validated"
          @click="submitScheme"
        >
          {{ $t('scheme.labels.apply') }}
        </v-btn>
      </v-col>
    </v-row>
  </v-sheet>
</template>

<script lang="ts">
import { ApiError } from '../../lib/models/errors';
import { Vue, Component, Emit, Prop } from 'vue-property-decorator';

import SchemeInputDatePicker from './SchemeInputDatePickerComponent.vue';
import SchemeInputTime from './SchemeInputTimeComponent.vue';
import SchemeConfirm from './SchemeConfirmComponent.vue';
import { SchemeInputData } from '../../lib/models/event';

@Component({
  components: {
    SchemeInputDatePicker,
    SchemeInputTime,
    SchemeConfirm,
  }
})
export default class SchemeInputComponent extends Vue {
  @Prop(Function)
  readonly callback?: (scheme: SchemeInputData) => Promise<void>;

  @Prop(Object)
  readonly scheme?: SchemeInputData;

  loading = false;
  confirmed = false;

  name = '';
  startAt: {
    date: string,
    time: string
  } = {
    date: '',
    time: ''
  }
  endAt: {
    date: string,
    time: string
  } = {
    date: '',
    time: ''
  }
  explanation = '';

  created(): void {
    if (!this.scheme) {
      return;
    }

    this.name = this.scheme.name;
    this.startAt = {
      date: this.scheme.startAt ? this.scheme.startAt.toLocaleDateString() : '',
      time: this.scheme.startAt ? `${this.scheme.startAt.getHours()}:${this.scheme.startAt.getMinutes()}` : '',
    };
    this.endAt = {
      date: this.scheme.endAt ? this.scheme.endAt.toLocaleDateString() : '',
      time: this.scheme.endAt ? `${this.scheme.endAt.getHours()}:${this.scheme.endAt.getMinutes()}` : '',
    };
    this.explanation = this.scheme.explanation;
  }

  get validated(): boolean {
    if (!this.name || !this.explanation) {
      return false;
    }

    if (
      (this.startAt.date === '' && this.startAt.time !== '')
      || (this.startAt.date !== '' && this.startAt.time === '')
    ) {
      return false;
    }

    if (
      (this.endAt.date === '' && this.endAt.time !== '')
      || (this.endAt.date !== '' && this.endAt.time === '')
    ) {
      return false;
    }

    return true;
  }

  @Emit()
  async submitScheme(): Promise<void> {
    if (!this.callback) {
      return;
    }

    if (!this.validated) {
      return;
    }

    const params = {
      name: this.name,
      startAt: this.startAt.date !== '' ? this._makeDatetime(this.startAt) : null,
      endAt: this.endAt.date !== '' ? this._makeDatetime(this.endAt) : null,
      explanation: this.explanation,
    };

    this.loading = true;
    try {
      await this.callback(params);
      // await apiModule.postScheme(params);
      // this.confirmed = true;
    } catch (e) {
      alert((e as ApiError).message);
      console.error(e);
    } finally {
      this.loading = false;
    }
  }

  private _makeDatetime(dateObj: {
    date: string,
    time: string,
  }): Date {
    const date = new Date(Date.parse(dateObj.date));
    const splitTime = dateObj.time.split(':');
    date.setHours(parseInt(splitTime[0]));
    date.setMinutes(parseInt(splitTime[1]));
    return date;
  }
}
</script>
