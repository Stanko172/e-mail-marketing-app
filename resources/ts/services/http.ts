import Axios, { AxiosInstance } from 'axios';

class Http {
    client: AxiosInstance;

    constructor() {
        this.client = Axios.create({});
    }
}
