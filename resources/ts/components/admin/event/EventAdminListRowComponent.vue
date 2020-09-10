<template>
  <v-sheet>
    <v-container>
      <v-row>
        <v-text-field
          :label="$t('admin.event.labels.preview.id')"
          :value="event.id"
          readonly
        ></v-text-field>
      </v-row>
      <v-row>
        <v-text-field
          :label="$t('admin.event.labels.preview.name')"
          :value="event.name"
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
          :disabled="updating || deleting"
        ></v-select>
      </v-row>
      <v-row>
        <v-text-field
          v-model="slug"
          :label="$t('admin.event.labels.preview.slug')"
          :disabled="updating || deleting"
        ></v-text-field>
      </v-row>
      <v-row justify="end">
        <v-btn
          class="mx-2"
          color="success"
          :disabled="!isPostable || deleting"
          :loading="updating"
          @click="editEvent"
        >
          {{ $t('admin.event.labels.edit.edit') }}
        </v-btn>
        <v-btn
          class="mx-2"
          color="error"
          :disabled="!isPostable || updating"
          :loading="deleting"
          @click="deleteEvent"
        >
          {{ $t('admin.event.labels.edit.delete') }}
        </v-btn>
      </v-row>
    </v-container>
  </v-sheet>
</template>

<script lang="ts">
import { Vue, Component, Prop, Emit } from 'vue-property-decorator';

import { RelateType, Event } from '../../../lib/models/event';
import { apiModule } from '../../../modules/api';
import { eventAdminModule } from '../../../modules/events';

@Component
export default class EventAdminListRowComponent extends Vue {

  @Prop(Object)
  event!: Event;

  relateType: RelateType = 'moderate';
  slug = '';

  updating = false;
  deleting = false;

  created(): void {
    this.relateType = this.event.relateType;
    this.slug = this.event.slug;
  }

  get startDateLocaleString(): string {
    return this.event.startAt.toLocaleString();
  }

  get endDateLocaleString(): string {
    return this.event.endAt.toLocaleString();
  }

  get isPostable(): boolean {
    return (this.slug !== '');
  }

  @Emit()
  async editEvent(): Promise<void> {
    this.updating = true;
    try {
      await apiModule.putEvent({
        id: this.event.id,
        relateType: this.relateType,
        slug: this.slug
      });
      this.updating = false;
      eventAdminModule.updateEvents();
    } catch (e) {
      console.error(e);
      this.updating = false;
    }
  }

  @Emit()
  async deleteEvent(): Promise<void> {
    this.deleting = true;
    try {
      await apiModule.deleteEvent(this.event.id);
      this.deleting = false;
      eventAdminModule.deleteEvent(this.event.id);
    } catch (e) {
      console.error(e);
      this.deleting = false;
    }
  }
}
</script>
