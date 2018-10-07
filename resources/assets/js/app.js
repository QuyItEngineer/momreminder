/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Toasted from 'vue-toasted';
import VueCodemirror from 'vue-codemirror';
import VueRouter from 'vue-router';
import Meta from 'vue-meta';
import 'codemirror/lib/codemirror.css';
import 'codemirror/mode/javascript/javascript';
import 'codemirror/mode/php/php';
import store from './store';
import router from './router';

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);
Vue.use(Meta);

Vue.use(Toasted, {
    position: 'bottom-right',
    duration: 3000,

});

Vue.use(VueCodemirror, {
    options: {
        lineNumbers: true,
        line: true,
        matchBrackets: true,
        indentUnit: 4,
        indentWithTabs: true,
        enterMode: 'keep',
        tabMode: 'shift',
    },
});

Vue.component('code-editor', require('./components/CodeEditor.vue'));
Vue.component('addable', require('./components/Addable.vue'));
Vue.component('get-list-story', require('./components/GetListStory.vue'));
Vue.component('reader-app', require('./pages/ReaderApp.vue'));
Vue.component('contact-form', require('./components/ContactForm.vue'));
Vue.component('template-form', require('./components/TemplateForm.vue'));
Vue.component('campaign-form', require('./components/CampaignForm.vue'));
Vue.component('bulk-button', require('./components/BulkButton.vue'));
Vue.component('c-checkbox', require('./components/CCheckbox.vue'));
Vue.component('checkbox-all', require('./components/CheckboxAll.vue'));
Vue.component('audio-record', require('./components/AudioRecord.vue'));
Vue.component('list-contact-editable', require('./components/ListContactEditable.vue'));
Vue.component('setting-email-form', require('./components/SettingEmailForm.vue'));
Vue.component('update-credit-card-form', require('./components/stripe/UpdateCreditCardForm.vue'));
Vue.component('charge-credit', require('./components/stripe/ChargeCredit.vue'));
Vue.component('custom-charge-credit', require('./components/stripe/CustomChargeCredit.vue'));

const app = new Vue({
    el: '#app',
    store,
    router,
});

window.app = app;