<template>
  <div>
    <h3>{{ $t('admin.event.headers.import') }}</h3>
    <v-row align="center">
      <v-col
        cols="12"
        md="10"
      >
        <v-text-field
          v-model="marathonId"
          :label="$t('admin.event.labels.import.input')"
        >
        </v-text-field>
      </v-col>
      <v-col>
        <v-btn
          color="info"
          block
          @click="preview"
        >
          {{ $t('admin.event.labels.import.button') }}
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="12"
      >
        <v-progress-circular
          v-if="loading"
          indeterminate
        ></v-progress-circular>
        <div
          v-else-if="previewMarathon !== null"
          class="pa-2"
        >
          <h4>{{ $t('admin.event.labels.import.result') }}</h4>
          <event-admin-preview
            :oengus-marathon="previewMarathon"
            :callback="resetImport"
          ></event-admin-preview>
        </div>
      </v-col>
    </v-row>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Emit } from 'vue-property-decorator';
import { getMarathon, OengusMarathon } from 'oengus-api';

import EventAdminPreview from './EventAdminPreviewComponent.vue';
import { eventAdminModule } from '../../../modules/events';

@Component({
  components: {
    EventAdminPreview
  }
})
export default class EventAdminImportComponent extends Vue {

  marathonId = '';
  loading = false;
  previewMarathon: OengusMarathon|null = null;

  @Emit()
  async preview(): Promise<void> {
    this.loading = true;
    this.previewMarathon = null;
    try {
      this.previewMarathon = await getMarathon(this.marathonId);
    } catch (e) {
      console.error(e);
    }
    this.loading = false;
  }

  @Emit()
  resetImport(): void {
    this.previewMarathon = null;
    eventAdminModule.updateEvents();
  }
}
</script>
