<template>
    <v-app class="tw-text-base tw-text-gray-700">

        <div class="border-bottom tw-border-b">
            <div class="tw-container tw-mx-auto tw-py-4 tw-px-4 md:tw-px-0">
                <div class="tw-font-bold tw-text-xl tw-inline-block tw-cursor-pointer" @click="$router.push({path: '/'})">HELP4U</div>

                <div class="tw-float-right">
                    <div class="tw-inline-block tw-mr-3" v-if="locale !== 'it-CH'">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="setLocale('it-CH')">{{ $t('OneWord.lang.italian') }}</div>
                    </div>
                    <div class="tw-inline-block tw-mr-3" v-if="locale !== 'de-CH'">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="setLocale('de-CH')">{{ $t('OneWord.lang.german') }}</div>
                    </div>
                    <div class="tw-inline-block tw-mr-3">|</div>
                    <div class="tw-inline-block mr-3" v-if="isLoggedIn">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="logout">{{ $t('OneWord.logout') }}</div>
                    </div>
                    <div class="tw-inline-block" v-if="isLoggedIn">
                        <v-btn color="primary" @click="$router.push({name: 'profile.inquiries'})">{{ $t('OneWord.myProfile') }}</v-btn>
                    </div>
                    <div class="tw-inline-block tw-mr-3" v-if="!isLoggedIn">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="$router.push({name: 'register-user'})">{{ $t('OneWord.register') }}</div>
                    </div>
                    <div class="tw-inline-block" v-if="!isLoggedIn">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="$router.push({name: 'login'})">{{ $t('OneWord.login') }}</div>
                    </div>
                </div>

            </div>
        </div>

        <router-view></router-view>

        <div>
            <div class="tw-container tw-mx-auto">
                <div class="my-8 tw-py-4 tw-px-4 md:tw-px-0">
                    <router-link :to="{name: 'impressum'}" class="hover:tw-underline">{{ $t('OneWord.impressum') }}</router-link>
                    <span class="mx-2">|</span>
                    <router-link :to="{name: 'datenschutz'}" class="hover:tw-underline">{{ $t('OneWord.dataPrivacy') }}</router-link>
                    <span class="mx-2">|</span>
                    <router-link :to="{name: 'agb'}" class="hover:tw-underline">{{ $t('OneWord.tac') }}</router-link>
                </div>
            </div>
        </div>

        <top-snackbar></top-snackbar>
    </v-app>
</template>

<script>
    import TopSnackbar from './components/TopSnackbar';
    import {mapActions, mapGetters} from 'vuex';
    import {EventBus} from './event-bus';

    export default {
        name: 'App',
        components: {TopSnackbar},
        props: {},

        data: () => ({}),
        computed: {
            ...mapGetters('user', {
                isLoggedIn: 'isLoggedIn',
                user: 'user',
                locale: 'locale',
            }),
        },
        methods: {
            ...mapActions('user', {
                loadUser: 'load',
                logout: 'logout',
                userSetLocale: 'setLocale',
            }),
            loggedIn(options) {
                this.loadUser().then(() => {
                    if (this.user.person_id === null) {
                        this.$router.push({name: 'profile.person'});
                    }
                    else if (_.has(options, 'redirect')) {
                        this.$router.push(options.redirect);
                    }

                    EventBus.$emit('change-locale', this.locale);
                });
            },
            setLocale(locale) {
                let lang = locale.substring(0, 2);

                this.userSetLocale(locale);
                EventBus.$emit('change-locale', locale);

                this.$vuetify.lang.current = lang;

                axios.post('api/set-locale', {locale: locale});
            },
        },
        mounted() {
            this.loggedIn();

            EventBus.$on('logged-in', this.loggedIn);
        },
    };
</script>

<style scoped>

</style>
