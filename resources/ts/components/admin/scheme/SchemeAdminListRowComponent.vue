<template>
  <v-container>
    <v-row
      v-if="scheme"
    >
      <v-col cols="auto">
        <scheme-status :status="scheme.status"></scheme-status>
      </v-col>
    </v-row>
    <v-row
      v-if="scheme"
    >
      <v-col
        cols="4"
        lg="2"
      >
        {{ $t('admin.labels.scheme.name') }}
      </v-col>
      <v-col cols="auto">
        {{ scheme.name }}
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="4"
        lg="2"
      >
        {{ $t('admin.labels.scheme.planner') }}
      </v-col>
      <v-col cols="auto">
        {{ scheme.planner.username }}
      </v-col>
      <v-col cols="2">
        <v-btn
          small
          icon
          target="_blank"
          :href="`https://discordapp.com/users/${scheme.planner.discord.id}`"
        >
          <v-icon>fab fa-discord</v-icon>
        </v-btn>
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="4"
        lg="2"
      >
        {{ $t('admin.labels.scheme.start') }}
      </v-col>
      <v-col cols="auto">
        {{ scheme.startAt ? scheme.startAt.toLocaleString() : '未定' }}
      </v-col>
    </v-row>
    <v-row>
      <v-col
        cols="4"
        lg="2"
      >
        {{ $t('admin.labels.scheme.end') }}
      </v-col>
      <v-col cols="auto">
        {{ scheme.startAt ? scheme.endAt.toLocaleString() : '未定' }}
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-textarea
          :label="$t('admin.labels.scheme.explanation')"
          :value="scheme.explanation"
          filled
          readonly
        ></v-textarea>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-textarea
          :label="$t('admin.labels.scheme.detail')"
          :value="scheme.detail"
          filled
          readonly
        ></v-textarea>
      </v-col>
    </v-row>
    <v-row>
      <scheme-admin-action
        :scheme="scheme"
        :callback="refreshScheme"
      ></scheme-admin-action>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Prop, Emit } from 'vue-property-decorator';
import { EventScheme } from '../../../lib/models/event';
import { apiModule } from '../../../modules/api';
import SchemeAdminAction from './SchemeAdminActionComponent.vue';
import SchemeStatus from './SchemeStatusComponent.vue';

@Component({
  components: {
    SchemeAdminAction,
    SchemeStatus,
  }
})
export default class SchemeAdminListRowComponent extends Vue {
  @Prop(Object)
  readonly defaultScheme!: EventScheme;

  scheme: EventScheme|null = null;

  created(): void {
    this.scheme = this.defaultScheme;
  }

  @Emit()
  async refreshScheme(): Promise<void> {
    if (this.scheme) {
    this.scheme = await apiModule.getScheme(this.scheme.id);
    }
  }
}
</script>
