export type User = {
  id: number;
  username: string;
  discord: Discord;
  permissions: Permissions;
}

export type Discord = {
  id: string;
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
