import { Permissions } from './auth';

export type Role = {
  id: string;
  name: string;
  permissions: Permissions;
}
