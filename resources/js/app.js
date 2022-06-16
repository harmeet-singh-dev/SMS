require('./bootstrap');
//toast message start
window.Toast = Swal.mixin({
 toast:true,
 position:'top-center',
 showConfirmButton:false,
 timer:4000,
 timerProgressBar:false,
 didOpen:(toast)=>{
toast.addEventListener('mouseenter',Swal.stopTimer)
toast.addEventListener('mouseleave',Swal.resumeTimer)
 }
})
//toast message end
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
