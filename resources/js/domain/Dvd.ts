export interface Dvd {
  title: string;
  genre: string;
  disponibility: string;
  price: number;
  description: string;
  image: string;
  links: Array<{
    rel: string;
    href: string;
  }>;
}

export interface Meta {
  current_page: number;
  from: number;
  last_page: number;
  links: Array<{
    url: string | null;
    label: string;
    active: boolean;
  }>;
  path: string;
  per_page: number;
  to: number;
  total: number;
}

export interface Links {
  first: string;
  last: string;
  prev: string | null;
  next: string | null;
}

export interface DvdApiResponse {
  data: {
    data: Dvd[];
    links: Links;
    meta: Meta;
  }
}