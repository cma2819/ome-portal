export type Discord = {
  id: string;
}

export type Channel = {
  twitch: Array<string>;
}

export type User = {
  id: number;
  username: string;
  discord: Discord;
  channels: Channel;
}
