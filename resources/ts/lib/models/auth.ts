import { UserChannel } from './stream';

export type User = {
  id: number;
  username: string;
  discord: DiscordProfile;
  channels: UserChannel;
  permissions: Permissions;
}

export type Permissions = Array<Domain>

export type Domain = 'twitter'|'admin';

export type DiscordProfile = {
  id: string;
  username: string;
  discriminator: string;
}

export type UserProfile = {
  id: number;
  username: string;
  discord: DiscordProfile;
}
