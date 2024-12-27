import { IHttpClient } from "./IHttpClient";

export class FetchGatway implements IHttpClient {
    get<T>(url: string, params?: any): Promise<T> {
        throw new Error("Method not implemented.");
    }
    post<T>(url: string, data?: any, params?: any): Promise<T> {
        throw new Error("Method not implemented.");
    }
    put<T>(url: string, data?: any, params?: any): Promise<T> {
        throw new Error("Method not implemented.");
    }
    patch<T>(url: string, data?: any, params?: any): Promise<T> {
        throw new Error("Method not implemented.");
    }
    delete<T>(url: string, params?: any): Promise<T> {
        throw new Error("Method not implemented.");
    }
}
