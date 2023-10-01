import Axios, { AxiosInstance, Method } from 'axios';

class Http {
    client: AxiosInstance;

    constructor() {
        this.client = Axios.create(); // TODO: add base URL from .env
    }

    public request<T>(
        method: Method,
        url: string,
        data: Record<string, any> = {},
        onUploadProgress?: any
    ) {
        return this.client.request({
            url,
            data,
            method,
            onUploadProgress,
        }) as Promise<{ data: T }>;
    }

    public async get<T>(url: string) {
        return (await this.request<T>('get', url)).data;
    }

    public async post<T>(
        url: string,
        data: Record<string, any>,
        onUploadProgress?: any
    ) {
        return (await this.request<T>('post', url, data, onUploadProgress))
            .data;
    }

    public async put<T>(url: string, data: Record<string, any>) {
        return (await this.request<T>('put', url, data)).data;
    }

    public async patch<T>(url: string, data: Record<string, any> = {}) {
        return (await this.request<T>('patch', url, data)).data;
    }

    public async delete<T>(url: string, data: Record<string, any> = {}) {
        return (await this.request<T>('delete', url, data)).data;
    }
}

export const http = new Http();
