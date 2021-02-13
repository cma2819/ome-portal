export interface Paginate<T> {
  prev: number|null;
  current: number;
  next: number;
  data: Array<T>;
}
