<template>
    <div class="tw-container tw-mx-auto tw-p-8">

        <ValidationObserver v-slot="{handleSubmit}">
            <v-form>

                <v-card>
                    <v-card-text>

                        <v-alert type="info" border="left">
                            Bevor sie sich als neuer Helfer*in anmelden können, müssen Sie einen Benutzer anlegen.
                            Dies ermöglicht Ihnen die spüätere einfache Administartion und beantwortung von Anfragen.
                        </v-alert>

                        <validation-provider rules="required|email" name="Email" v-slot="{errors}">
                            <v-text-field
                                v-model="credentials.email"
                                type="email"
                                label="Email Adresse"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                        <validation-provider rules="required" name="Passwort" v-slot="{errors}">
                            <v-text-field
                                v-model="credentials.password"
                                type="password"
                                label="Passwort"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                    </v-card-text>
                    <v-card-actions class="pa-4">
                        <v-spacer></v-spacer>
                        <v-btn x-large color="grey" text @click="$router.push({name: 'register-user'})">Neu Registrieren</v-btn>
                        <v-btn x-large color="primary" @click="handleSubmit(login)">Anmelden</v-btn>
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
                        this.$router.push({name: 'profile'});
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
