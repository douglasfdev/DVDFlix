import { IHttpClient } from './IHttpClient';
import axios, { AxiosInstance, AxiosRequestConfig, AxiosResponse } from 'axios';

export class AxiosHttpClient implements IHttpClient {
  private readonly instance: AxiosInstance;

  constructor() {
    this.instance = axios.create({
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      baseURL: import.meta.env.VITE_APP_BASE_URL
    })
  }

  public get<T = any, R = AxiosResponse<T>, D = any>(
    url: string,
    options?: AxiosRequestConfig,
  ) {
    return this.instance.get<T, R, D>(url, options);
  }

  public post<T = any, R = AxiosResponse<T>, D = any>(url: string, data: D) {
    return this.instance.post<T, R, D>(url, data);
  }

  public put<T = any, R = AxiosResponse<T>, D = any>(url: string, data: D) {
    return this.instance.put<T, R, D>(url, data);
  }

  public patch<T = any, R = AxiosResponse<T>, D = any>(url: string, data: D) {
    return this.instance.patch<T, R, D>(url, data);
  }

  public delete<T = any, R = AxiosResponse<T>, D = any>(url: string) {
    return this.instance.delete<T, R, D>(url);
  }

  public head<T = any, R = AxiosResponse<T>, D = any>(url: string) {
    return this.instance.head<T, R, D>(url);
  }

  public options<T = any, R = AxiosResponse<T>, D = any>(url: string) {
    return this.instance.options<T, R, D>(url);
  }
}
