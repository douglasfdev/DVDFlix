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

export interface CommissionApiResponse {
  data: { data: Commission[] };
}
