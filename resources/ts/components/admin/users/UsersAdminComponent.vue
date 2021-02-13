<template>
  <users-admin-table></users-admin-table>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

import UsersAdminTable from './UsersAdminTableComponent.vue';

@Component({
  components: {
    UsersAdminTable
  }
})
export default class UsersAdminComponent extends Vue {}
</script>
