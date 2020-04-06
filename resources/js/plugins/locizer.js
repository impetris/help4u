import locizer from 'locizer';
import locizeEditor from 'locize-editor';
import Vue from 'vue';
import VueI18n from 'vue-i18n';
import {EventBus} from '../event-bus';
import store from '../store/index';

Vue.use(VueI18n);

var NAMESPACE = process.env.MIX_LOCIZE_NAMESPACE;
var PROJECTID = process.env.MIX_LOCIZE_PROJECTID;
var REFERENCELANGUAGE = 'de-CH';

const i18n = new VueI18n({
    locale: store.getters['user/locale'], // set locale
    messages: {}, // set locale messages
});

locizer.init({
    fallbackLng: 'de-CH',
    referenceLng: REFERENCELANGUAGE,
    projectId: PROJECTID,
    loadIfTranslatedOver: 0.1,
}).load(NAMESPACE, (err, translations, detectedLng) => {

    // build message catalog format
    // var messages = {};
    // messages[detectedLng] = translations;

    i18n.setLocaleMessage(detectedLng, translations);
    i18n.locale = detectedLng;

    // Create VueI18n instance with options
    // const i18n = new VueI18n({
    //     locale: detectedLng, // set locale
    //     messages: messages, // set locale messages
    //     missing: function(locale, path, vue) {
    //         // pipe to locize - that key will be created for you
    //         locizer.add(NAMESPACE, path, path);
    //     },
    // });

    // Create a Vue instance with `i18n` option
    // new Vue({i18n}).$mount('#app');

    // set body visible on ready
    // document.body.style.display = 'block';

    // init incontext editor
    locizeEditor.init({
        lng: detectedLng,
        defaultNS: NAMESPACE,
        referenceLng: REFERENCELANGUAGE,
        projectId: PROJECTID,
    });
});

EventBus.$on('change-locale', (locale) => {
    locizer.load(NAMESPACE, locale, (err, translations, detectedLng) => {
        i18n.setLocaleMessage(locale, translations);
        i18n.locale = locale;
    });
});

export default i18n;
