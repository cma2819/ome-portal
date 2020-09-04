export type RelateType = 'moderate'|'support';

export type Event = {
  id: string;
  name: string;
  startAt: Date;
  endAt: Date;
  relateType: RelateType;
  slug: string;
};
