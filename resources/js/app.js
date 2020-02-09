import './bootstrap';
import Vue from 'vue';

import App from './components/App';
import router from './routes';

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
