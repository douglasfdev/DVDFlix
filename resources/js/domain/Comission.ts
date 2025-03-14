export interface Commission {
  company: string;
  point_of_sale: string;
  seller: string;
  customer: string;
  city: string;
  state: string;
  sold_at: string;
  status: string;
  total_amount: number;
  comission: string;
}


export interface CommissionApiAxiosResponse {
  data: {
    data: Commission[];
  };
}

export interface CommissionApiFetchResponse {
    data: Commission[];
  }
