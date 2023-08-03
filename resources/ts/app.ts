import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
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
            .mixin({ methods: { route } })
            .mount(el);
    },
});
