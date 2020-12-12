import { UserProfile } from './auth';

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

export type SchemeStatus = 'applied' | 'approved' | 'denied' | 'confirmed';
export type SchemeInputData = {
  name: string;
  startAt: Date|null;
  endAt: Date|null;
  explanation: string;
};

export type EventScheme = {
  id: number;
  name: string;
  planner: UserProfile;
  status: SchemeStatus;
  startAt: Date;
  endAt: Date;
  explanation: string;
  detail: string;
}
