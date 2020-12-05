<template>
  <v-card>
    <v-card-title>
      応募済みのイベント
    </v-card-title>
    <v-card-text>
      <div
        v-for="scheme in schemes"
        :key="scheme.id"
        class="my-2"
      >
        <scheme-list-item
          :scheme="scheme"
        ></scheme-list-item>
      </div>
    </v-card-text>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { EventScheme } from '../../lib/models/event';

import SchemeListItem from './SchemeListItemComponent.vue';

@Component({
    components: {
      SchemeListItem,
    }
  })
export default class SchemeIndexComponent extends Vue {
  @Prop(Array)
  readonly schemes!: Array<EventScheme>;
}
</script>
