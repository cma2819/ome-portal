export type TwitterUser = {
  id: string;
  name: string;
  screenName: string;
}

export type TwitterUploadMedia = {
  id: string;
}

export type TwitterMedia = {
  id: string;
  mediaUrl: string;
  type: 'photo'|'video'|'animated_gif'
}

export type Timeline = Array<Tweet>;

export type Tweet = {
  id: string;
  text: string;
  user: TwitterUser;
  createdAt: string;
  medias: Array<TwitterMedia>
}
