<template>
    <v-app class="tw-text-base tw-text-gray-700">

        <div class="border-bottom tw-border-b">
            <div class="tw-container tw-mx-auto tw-py-4 tw-px-4 md:tw-px-0">
                <div class="tw-font-bold tw-text-xl tw-inline-block tw-cursor-pointer" @click="$router.push({path: '/'})">HELP4U</div>

                <div v-if="isLoggedIn" class="tw-float-right">
                    <div class="tw-inline-block mr-3">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="logout">Abmelden</div>
                    </div>
                    <div class="tw-inline-block">
                        <v-btn color="primary" @click="$router.push({name: 'profile.inquiries'})">Mein Profil</v-btn>
                    </div>
                </div>
                <div v-else class="tw-float-right">
                    <div class="tw-inline-block tw-mr-3">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="$router.push({name: 'register-user'})">Registrieren</div>
                    </div>
                    <div class="tw-inline-block">
                        <div class="hover:tw-underline tw-cursor-pointer" @click="$router.push({name: 'login'})">Anmelden</div>
                    </div>
                </div>

            </div>
        </div>

        <router-view></router-view>

        <div>
            <div class="tw-container tw-mx-auto">
                <div class="my-8 tw-py-4 tw-px-4 md:tw-px-0">
                    <router-link :to="{name: 'impressum'}" class="hover:tw-underline">Impressum</router-link>
                    <span class="mx-2">|</span>
                    <router-link :to="{name: 'datenschutz'}" class="hover:tw-underline">Datenschutz</router-link>
                    <span class="mx-2">|</span>
                    <router-link :to="{name: 'agb'}" class="hover:tw-underline">AGB</router-link>
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
            }),
        },
        methods: {
            ...mapActions('user', {
                loadUser: 'load',
                logout: 'logout',
            }),
            loggedIn(options) {
                this.loadUser().then(() => {
                    if (this.user.person_id === null) {
                        this.$router.push({name: 'profile.person'});
                    }
                    else if (_.has(options, 'redirect')) {
                        this.$router.push(options.redirect);
                    }
                });
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
