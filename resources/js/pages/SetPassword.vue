<template>
    <div class="tw-container tw-mx-auto tw-p-8">

        <ValidationObserver v-slot="{handleSubmit}">
            <v-form>

                <v-card>
                    <v-card-text>

                        <validation-provider rules="required|email" name="Email" v-slot="{errors}">
                            <v-text-field
                                v-model="reg.email"
                                type="email"
                                label="Email Adresse"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                        <validation-provider rules="required" name="Passwort" v-slot="{errors}">
                            <v-text-field
                                v-model="reg.password"
                                type="password"
                                label="Passwort"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                        <validation-provider rules="required" name="Passwort bestätigen" v-slot="{errors}">
                            <v-text-field
                                v-model="reg.password_confirmation"
                                type="password"
                                label="Passwort bestätigen"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>
                    </v-card-text>
                    <v-card-actions class="pa-4">
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click="handleSubmit(send)">Passwort zurücksetzen</v-btn>
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
        name: 'SetPassword',
        components: {ValidationObserver, ValidationProvider},
        data() {
            return {
                reg: {
                    email: null,
                    token: null,
                    password: null,
                    password_confirmation: null,
                },
                loading: false,
            };
        },
        methods: {
            send() {
                this.loading = true;

                axios.post('password/reset', this.reg).then(() => {
                    EventBus.$emit('success', 'Passwort erfolgreich gespeichert');
                    this.$router.push({name: 'profile.inquiries'})
                }).finally(() => {
                    this.loading = false;
                });
            },
        },
        mounted() {
            this.reg.email = this.$route.query.email;
            this.reg.token = this.$route.query.token;
        },
    };
</script>

<style scoped>

</style>
