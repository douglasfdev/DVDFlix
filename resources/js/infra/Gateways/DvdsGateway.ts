import { FetchHttpClient } from "../Http";
import { IHttpClient } from "../Http/IHttpClient";
import { AxiosError } from "axios";

class DvdsGateway {
  constructor(private readonly httpClient: IHttpClient) { }

  async getDvds<T = any>(params?: any): Promise<T> {
    try {
      return this.httpClient.get<T>(`/api/v1/dvds`, {params});
    }
    catch (error) {
      if (error instanceof Error || error instanceof AxiosError) {
        throw new Error(error.message);
      }
      throw new Error('Unexpected error occurred');
    }
  }
}

export default new DvdsGateway(new FetchHttpClient());
