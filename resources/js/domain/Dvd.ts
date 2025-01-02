import { Links, Meta } from "@/infra/domain";

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

export interface DvdApiAxiosResponse {
    data: {
      data: Dvd[];
      links: Links;
      meta: Meta;
    };
}

export interface DvdApiFetchResponse {
    data: Dvd[];
    links: Links;
    meta: Meta;
}
