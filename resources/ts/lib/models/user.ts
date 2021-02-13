import { Discord } from './auth';

export type User = {
  id: number;
  username: string;
  discord: Discord;
}
