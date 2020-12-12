<template>
  <v-card
    color="primary"
    dark
  >
    <v-card-title>
      <scheme-list-item-status
        :status="scheme.status"
      ></scheme-list-item-status>
      {{ scheme.name }}
    </v-card-title>
    <v-card-subtitle
      v-if="scheme.startAt || scheme.endAt"
    >
      <span v-if="scheme.startAt">
        {{ scheme.startAt.toLocaleString() }}
      </span>
      ～
      <span v-if="scheme.endAt">
        {{ scheme.endAt.toLocaleString() }}
      </span>
    </v-card-subtitle>
    <v-card-text>
      {{ scheme.explanation }}
    </v-card-text>
    <v-card-actions>
      <v-tooltip top>
        <template v-slot:activator="{ on, attrs }">
          <span
            v-bind="attrs"
            v-on="on"
          >
            <v-btn
              text
              :disabled="scheme.status !== 'applied'"
              :to="{
                name: 'edit',
                params: {
                  schemeId: scheme.id
                }
              }"
            >
              <v-icon>fas fa-edit</v-icon>
              {{ $t('scheme.labels.edit.label') }}
            </v-btn>
          </span>
        </template>
        <span>{{ $t('scheme.labels.edit.rule') }}</span>
      </v-tooltip>
    </v-card-actions>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { EventScheme } from '../../lib/models/event';

import SchemeListItemStatus from './SchemeListItemStatusComponent.vue';

@Component({
  components: {
    SchemeListItemStatus
  }
})
export default class SchemeListItemComponent extends Vue {
  @Prop(Object)
  readonly scheme!: EventScheme;

}
</script>
