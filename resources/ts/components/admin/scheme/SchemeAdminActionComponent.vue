<template>
  <v-container>
    <v-row>
      <v-col>
        <v-textarea
          v-model="reply"
          label="返答コメント"
          outlined
          rows="2"
        ></v-textarea>
      </v-col>
    </v-row>
    <v-row
      justify="end"
    >
      <v-col cols="auto">
        <v-btn
          v-if="canApprove"
          color="primary"
          :loading="loading"
          :disabled="!repliable"
          @click="approve"
        >
          {{ $t('admin.labels.scheme.actions.approve') }}
        </v-btn>
        <v-btn
          v-if="canConfirm"
          :loading="loading"
          color="primary"
          :disabled="!repliable"
          @click="confirm"
        >
          {{ $t('admin.labels.scheme.actions.confirm') }}
        </v-btn>
        <v-btn
          v-if="canDeny"
          :loading="loading"
          color="secondary"
          :disabled="!repliable"
          @click="deny"
        >
          {{ $t('admin.labels.scheme.actions.deny') }}
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Prop, Emit } from 'vue-property-decorator';
import { EventScheme, SchemeStatus } from '../../../lib/models/event';
import { apiModule } from '../../../modules/api';

@Component
export default class SchemeAdminActionComponent extends Vue {
  @Prop(Object)
  readonly scheme!: EventScheme;

  @Prop(String)
  readonly status!: string;

  @Prop(Function)
  readonly callback!: () => void;

  loading = false;
  reply = '';

  get canApprove(): boolean {
    return this.scheme.status === 'applied';
  }

  @Emit()
  approve(): void {
    this.updateScheme('approved');
  }

  get canConfirm(): boolean {
    return this.scheme.status === 'approved';
  }

  @Emit()
  confirm(): void {
    this.updateScheme('confirmed');
  }

  get canDeny(): boolean {
    return this.scheme.status === 'applied';
  }

  @Emit()
  deny(): void {
    this.updateScheme('denied');
  }

  get repliable(): boolean {
    return !!this.reply && this.reply !== '';
  }

  refreshInput(): void {
    this.reply = '';
  }

  async updateScheme(status: SchemeStatus): Promise<void> {
    this.loading = true;
    if (!this.repliable) {
      return;
    }

    try {
      await apiModule.putSchemeStatus({
        id: this.scheme.id,
        status: status,
        reply: this.reply,
      })
      this.refreshInput();
      this.callback();
    } catch (e) {
      alert(e);
    } finally {
      this.loading = false;
    }
  }
}
</script>
