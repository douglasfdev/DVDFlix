export interface IHttpClient {
  get<T>(url: string, params?: any): Promise<T>;

  post<T>(url: string, data?: any, params?: any): Promise<T>;

  put<T>(url: string, data?: any, params?: any): Promise<T>;

  patch<T>(url: string, data?: any, params?: any): Promise<T>;

  delete<T>(url: string, params?: any): Promise<T>;
}