export type TwitterUser = {
  id: number;
  name: string;
  screenName: string;
}

export type TwitterUploadMedia = {
  mediaId: number;
}

export type TwitterMedia = {
  id: number;
  mediaUrl: string;
  type: 'photo'|'video'|'animated_gif'
}

export type Timeline = Array<Tweet>;

export type Tweet = {
  id: number;
  text: string;
  user: TwitterUser;
  createdAt: string;
  medias: Array<TwitterMedia>
}
