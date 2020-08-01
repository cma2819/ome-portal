export type TwitterUser = {
  id: number;
  name: string;
  screenName: string;
}

export type TwitterMedia = {
  mediaId: number;
}

export type Timeline = Array<Tweet>;

export type Tweet = {
  id: number;
  text: string;
  user: TwitterUser;
  createdAt: string;
}
