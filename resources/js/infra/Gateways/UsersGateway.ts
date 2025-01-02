import { AxiosHttpClient } from "../Http";
import { IHttpClient } from "../Http/IHttpClient";
import { AxiosError } from "axios";

class UsersGateway {
    constructor(private readonly httpClient: IHttpClient) { }
    async getCustomers<T = any>(params?: any): Promise<T> {
        try {
            return this.httpClient.get<T>(`/api/v1/customers`, params);
        } catch (error) {
            if (error instanceof Error || error instanceof AxiosError) {
                throw new Error(error.message);
            }
            throw new Error('Unexpected error occurred');
        }
    }
}

export default new UsersGateway(new AxiosHttpClient());
