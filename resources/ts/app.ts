import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import '../css/app.css';

createInertiaApp({
    // @ts-ignore
    resolve: (name) => {
        const pages = import.meta.glob('./components/pages/**/*.vue', {
            eager: true,
        });
        return pages[`./components/pages/${name}.vue`];
    },
    // @ts-ignore
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Vue3Toasity)
            .mixin({ methods: { route } })
            .mount(el);
    },
});
