require('./bootstrap');

import Vue from 'vue';
//import exampleComponent from './vue/exampleComponent';
import FlashSuccess from './vue/FlashSuccess';
import FlashWarning from './vue/FlashWarning'

const app = new Vue({
    el: '#app',
    components: {FlashSuccess, FlashWarning}
});
