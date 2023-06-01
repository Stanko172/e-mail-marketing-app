import { RouteParam, RouteParamsWithQueryOverload } from 'ziggy-js';
declare module '*.vue' {
    import { defineComponent } from 'vue';

    const component: ReturnType<typeof defineComponent>;

    export default component;
}

declare global {
    const route: (
        name?: string,
        params?: RouteParamsWithQueryOverload | RouteParam
    ) => string;
}
