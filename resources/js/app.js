require('./bootstrap');

import Vue from 'vue';
import exampleComponent from './vue/exampleComponent';
import FlashSuccess from './vue/FlashSuccess';
import FlashWarning from './vue/FlashWarning';
import BackToTop from './vue/BackToTop'

const app = new Vue({
    el: '#app',
    components: {FlashSuccess, FlashWarning, BackToTop},

    mounted() {
        if(location.hash) {
           // console.log(location.hash)
            setTimeout(() => {
                let el = location.hash.replace('scroll-to-', '');
                document.querySelector(el).scrollIntoView({behavior: 'smooth'});
            }, 350);

        }
        //document.querySelector('#comments').scrollIntoView({scrollBehavior: 'smooth'});
    }
});
import router from './router';
import AdminPanel from './vue/AdminPanel'

const admin = new Vue({
    router,
    render: h => h(AdminPanel),

}).$mount('#admin');
