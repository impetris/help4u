<template>
    <div class="tw-container tw-mx-auto tw-p-8">

        <ValidationObserver v-slot="{handleSubmit}">
            <v-form>

                <v-card>
                    <v-card-text>

                        <v-alert type="info" border="left">
                            {{ $t('Login.infoText') }}
                        </v-alert>

                        <validation-provider rules="required|email" :name="$t('OneWord.email')" v-slot="{errors}">
                            <v-text-field
                                v-model="credentials.email"
                                type="email"
                                :label="$t('OneWord.email')"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                        <validation-provider rules="required" :name="$t('OneWord.password')" v-slot="{errors}">
                            <v-text-field
                                v-model="credentials.password"
                                type="password"
                                :label="$t('OneWord.password')"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                    </v-card-text>
                    <v-card-actions class="pa-4">
                        <router-link :to="{name: 'reset-password'}">{{ $t('OneWord.forgotPassword') }}</router-link>
                        <v-spacer></v-spacer>
                        <v-btn x-large color="grey" text @click="$router.push({name: 'register-user'})" class="hidden-md-and-down">{{ $t('OneWord.registerNew') }}</v-btn>
                        <v-btn x-large color="primary" @click="handleSubmit(login)">{{ $t('OneWord.login') }}</v-btn>
                    </v-card-actions>

                </v-card>
            </v-form>

        </ValidationObserver>
    </div>
</template>

<script>
    import {ValidationObserver, ValidationProvider} from 'vee-validate';
    import {EventBus} from '../event-bus';

    export default {
        name: 'Login',
        components: {ValidationObserver, ValidationProvider},
        data() {
            return {
                credentials: {
                    username: null,
                    password: null,
                },
            };
        },
        methods: {
            login() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('/login', this.credentials).then(() => {
                        EventBus.$emit('success', 'Erfolgreich angemeldet.');
                        EventBus.$emit('logged-in');
                        this.$router.push({name: 'home'});
                    }).catch(() => {
                        EventBus.$emit('error', 'Email / Passwort ungültig.');
                    });
                });
            },
        },
    };
</script>

<style scoped>

</style>
