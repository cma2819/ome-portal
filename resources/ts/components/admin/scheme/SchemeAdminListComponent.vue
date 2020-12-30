<template>
  <v-expansion-panels>
    <v-expansion-panel
      v-for="scheme in filteredSchemes"
      :key="scheme.id"
      :style="{
        borderLeft: `4px solid ${$vuetify.theme.themes.light.secondary}`
      }"
    >
      <v-expansion-panel-header>
        {{ scheme.name }}
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <scheme-admin-list-row :default-scheme="scheme"></scheme-admin-list-row>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import { apiModule } from '../../../modules/api';
import { EventScheme } from '../../../lib/models/event';
import SchemeAdminListRow from './SchemeAdminListRowComponent.vue';

@Component({
  components: {
    SchemeAdminListRow,
  }
})
export default class ScehmeAdminListComponent extends Vue {
  @Prop(Boolean)
  readonly showDenied!: boolean;

  schemes: Array<EventScheme> = [];

  async created (): Promise<void> {
    this.schemes = await apiModule.getSchemes({});
  }

  get filteredSchemes(): Array<EventScheme> {
    if (!this.showDenied) {
      return this.schemes.filter((scheme) => {
        return scheme.status !== 'denied';
      })
    }

    return this.schemes;
  }
}
</script>
