import { AxiosHttpClient } from "../Http";
import { IHttpClient } from "../Http/IHttpClient";

class DvdsGateway {
  constructor(private readonly httpClient: IHttpClient) { }

  async getDvds<T = any>(params?: any): Promise<T> {
    try {
      return this.httpClient.get<T>(`/api/v1/dvds`, params);
    }
    catch (error) {
      throw error;
    }
  }
}

export default new DvdsGateway(new AxiosHttpClient());