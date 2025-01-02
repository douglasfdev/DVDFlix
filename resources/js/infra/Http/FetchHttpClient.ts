import { IHttpClient } from "./IHttpClient";

export class FetchHttpClient implements IHttpClient {
    private headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };

    async request<T>(method: 'GET' | 'POST' | 'PUT' | 'PATCH' | 'DELETE',
        url: string,
        data?: any,
        params?: Record<string, string>
    ): Promise<T> {
        const queryString = params
            ? '?' + new URLSearchParams(params).toString()
            : '';

        const req = await fetch(url + queryString, {
            method,
            headers: this.headers,
            body: ['POST', 'PUT', 'PATCH'].includes(method) ? JSON.stringify(data) : undefined,
        });

        if (!req.ok) {
            throw new Error(req.statusText);
        }

        return req.json();
    }

    async get<T>(url: string, params?: any): Promise<T> {
        return this.request<T>('GET', url, undefined, params);
    }
    async post<T>(url: string, data?: any, params?: any): Promise<T> {
        return this.request<T>('POST', url, data, params);
    }
    put<T>(url: string, data?: any, params?: any): Promise<T> {
        return this.request<T>('PUT', url, data, params);
    }
    patch<T>(url: string, data?: any, params?: any): Promise<T> {
        return this.request<T>('PATCH', url, data, params);
    }
    delete<T>(url: string, params?: any): Promise<T> {
        return this.request<T>('DELETE', url, undefined, params);
    }
}
