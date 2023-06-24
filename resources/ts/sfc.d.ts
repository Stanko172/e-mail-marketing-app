import type { default as _route } from 'ziggy-js';

type ZiggyRoute = typeof _route;
declare module '*.vue' {
    import { defineComponent } from 'vue';

    const component: ReturnType<typeof defineComponent>;

    export default component;
}

declare global {
    let route: typeof ZiggyRoute;
    let $route: typeof ZiggyRoute;
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: typeof ZiggyRoute;
        $route: typeof ZiggyRoute;
    }
}
