export type RelateType = 'moderate'|'support';

export type Status = 'freshed'|'selected'|'scheduled'|'closed';

export type Event = {
  id: string;
  name: string;
  startAt: Date;
  endAt: Date;
  relateType: RelateType;
  slug: string;
  submitsOpen: boolean;
  status: Status;
};
