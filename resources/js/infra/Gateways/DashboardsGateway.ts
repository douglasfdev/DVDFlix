import { AxiosError } from "axios";
import { IHttpClient } from "../Http/IHttpClient";
import { FetchHttpClient } from "../Http";

class DashboardsGateway {
  constructor(private readonly httpClient: IHttpClient) { }

  async getComissions<T = any>(params?: any): Promise<T> {
    try {
      return this.httpClient.get<T>(`/api/v1/dashboards/sellersComissions`);
    }
    catch (error) {
      if (error instanceof Error || error instanceof AxiosError) {
        throw new Error(error.message);
      }
      throw new Error('Unexpected error occurred');
    }
  }
}

export default new DashboardsGateway(new FetchHttpClient());
