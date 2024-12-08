import { AxiosHttpClient } from "../Http";
import { IHttpClient } from "../Http/IHttpClient";

class DashboardsGateway {
  constructor(private readonly httpClient: IHttpClient) { }

  async getComissions<T = any>(params?: any): Promise<T> {
    try {
      return this.httpClient.get<T>(`/api/v1/dashboards/sellersComissions`, params);
    }
    catch (error) {
      throw error;
    }
  }
}

export default new DashboardsGateway(new AxiosHttpClient());