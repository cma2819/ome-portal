export type TwitchUser = {
  id: string,
  username: string,
}

export type UserChannel = {
  twitch: Array<TwitchUser>;
}
