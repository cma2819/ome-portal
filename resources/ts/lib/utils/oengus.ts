import { parse } from 'iso8601-duration';
import { OengusCategory, OengusRunType } from 'oengus-api';

export const isoTimeString = (isoTime: string): string => {
  const duration = parse(isoTime);

  return [
    ((duration.days || 0 * 24) + (duration.hours || 0)).toString().padStart(2, '0'),
    (duration.minutes || 0).toString().padStart(2, '0'),
    (duration.seconds || 0).toString().padStart(2, '0')
  ].join(':');
}

export const isSingleRun = (category: OengusCategory): boolean => {
  return category.type === OengusRunType.single;
}

export const isRaceRun = (category: OengusCategory): boolean => {
  return category.type === OengusRunType.race;
}

export const isCoopRun = (category: OengusCategory): boolean => {
  return category.type === OengusRunType.coop;
}

export const isCoopRaceRun = (category: OengusCategory): boolean => {
  return category.type === OengusRunType.coopRace;
}
