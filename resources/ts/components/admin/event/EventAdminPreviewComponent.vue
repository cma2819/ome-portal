<template>
  <v-sheet>
    <v-container>
      <v-row>
        <v-text-field
          :label="$t('admin.event.labels.preview.id')"
          :value="oengusMarathon.id"
          readonly
        ></v-text-field>
      </v-row>
      <v-row>
        <v-text-field
          :label="$t('admin.event.labels.preview.name')"
          :value="oengusMarathon.name"
          readonly
        ></v-text-field>
      </v-row>
      <v-row>
        <v-text-field
          :label="$t('admin.event.labels.preview.start')"
          :value="startDateLocaleString"
          readonly
        ></v-text-field>
      </v-row>
      <v-row>
        <v-text-field
          :label="$t('admin.event.labels.preview.end')"
          :value="endDateLocaleString"
          readonly
        ></v-text-field>
      </v-row>
      <v-row>
        <v-select
          v-model="relateType"
          :label="$t('admin.event.labels.preview.relate')"
          :items="[
            'moderate', 'support'
          ]"
          :disabled="loading"
        ></v-select>
      </v-row>
      <v-row>
        <v-text-field
          v-model="slug"
          :label="$t('admin.event.labels.preview.slug')"
          :disabled="loading"
        ></v-text-field>
      </v-row>
      <v-row justify="end">
        <v-btn
          color="success"
          :disabled="!isPostable"
          :loading="loading"
          @click="importMarathon"
        >
          {{ $t('admin.event.labels.preview.import') }}
        </v-btn>
      </v-row>
    </v-container>
  </v-sheet>
</template>

<script lang="ts">
import { Vue, Component, Prop, Emit } from 'vue-property-decorator';

import { OengusMarathon } from 'oengus-api';
import { RelateType } from '../../../lib/models/event';
import { apiModule } from '../../../modules/api';

@Component
export default class EventAdminPreviewComponent extends Vue {

  @Prop(Object)
  oengusMarathon!: OengusMarathon;

  @Prop(Function)
  callback!: () => void;

  relateType: RelateType = 'moderate';
  slug = '';

  loading = false;

  get startDateLocaleString(): string {
    return new Date(Date.parse(this.oengusMarathon.startDate)).toLocaleString();
  }

  get endDateLocaleString(): string {
    return new Date(Date.parse(this.oengusMarathon.endDate)).toLocaleString();
  }

  get isPostable(): boolean {
    return (this.slug !== '');
  }

  @Emit()
  async importMarathon(): Promise<void> {
    this.loading = true;
    try {
      await apiModule.postEvent({
        id: this.oengusMarathon.id,
        relateType: this.relateType,
        slug: this.slug
      });
      this.loading = false;
      this.callback();
    } catch (e) {
      console.error(e);
      this.loading = false;
    }
  }
}
</script>
