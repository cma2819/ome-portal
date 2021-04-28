<template>
  <v-card>
    <v-card-subtitle>
      {{ $t('scheme.headers.scheme.list') }}
    </v-card-subtitle>
    <v-card-text>
      <fade-transaction>
        <div
          v-if="schemes !== null"
          key="list"
        >
          <div v-if="schemes">
            <v-card
              v-for="s in status"
              :key="s"
              class="mb-2"
            >
              <v-card-subtitle>
                {{ $t(`scheme.status.${s}`) }}
              </v-card-subtitle>
              <v-card-text v-if="schemes[s].length > 0">
                <scheme-list-item
                  v-for="scheme in schemes[s]"
                  :key="scheme.id"
                  :scheme="scheme"
                  class="ma-1"
                ></scheme-list-item>
              </v-card-text>
              <v-card-text v-else>
                {{ $t('scheme.messages.empty') }}
              </v-card-text>
            </v-card>
          </div>
        </div>
        <div
          v-else
          key="loading"
        >
          <linear-loading></linear-loading>
        </div>
      </fade-transaction>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';
import { EventScheme, SchemeStatus } from '../../lib/models/event';
import { apiModule } from '../../modules/api';

import SchemeListItem from './SchemeListItemComponent.vue';
import LinearLoading from '../LinearLoadingComponent.vue';
import FadeTransaction from '../FadeTransitionComponent.vue';

@Component({
    components: {
      SchemeListItem,
      LinearLoading,
      FadeTransaction,
    }
  })
export default class SchemeIndexComponent extends Vue {
  schemes: {[k in SchemeStatus]: Array<EventScheme>}|null = null;

  async mounted():Promise<void> {
    try {
      const user = await apiModule.getAuthMe();
      const schemes = await apiModule.getSchemes({
        planner: user.id,
      });

      this.schemes = {
        applied: schemes.filter(scheme => scheme.status === 'applied'),
        approved: schemes.filter(scheme => scheme.status === 'approved'),
        confirmed: schemes.filter(scheme => scheme.status === 'confirmed'),
        denied: schemes.filter(scheme => scheme.status === 'denied'),
      };

    } catch (e) {
      // do nothing
    }
  }

  get status(): Array<SchemeStatus> {
    return [
      'applied',
      'approved',
      'confirmed',
      'denied',
    ];
  }
}
</script>
