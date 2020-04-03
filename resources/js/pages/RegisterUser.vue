<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-16">

            <ValidationObserver v-slot="{handleSubmit}">

                <v-form>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Als neue Helfer*in Registrieren
                    </div>

                    <div class="tw-m-8">

                        <v-alert :value="error" color="error" border="left" dismissible>
                            <strong>{{ errorMessage }}</strong>

                            <ul v-if="errorDetails" class="tw-list-disc mt-2">
                                <li v-for="(value, propertyName) in errorDetails">{{ value[0] }}</li>
                            </ul>
                        </v-alert>

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|email" name="Email" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.email"
                                        type="email"
                                        label="Email Adresse"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|min:8|max:255" name="Passwort" vid="confirm" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.password"
                                        type="password"
                                        label="Passwort"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|min:8|max:255" name="Passwort wiederholen" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.password_confirmation"
                                        type="password"
                                        label="Passwort wiederholen"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>

                        <div class="tw-text-right">
                            <v-btn x-large color="primary" @click="handleSubmit(save)">Speichern</v-btn>
                        </div>
                    </div>
                </v-form>
            </ValidationObserver>
        </div>
    </div>
</template>

<script>
    import {ValidationObserver, ValidationProvider} from 'vee-validate';
    import {EventBus} from '../event-bus';

    export default {
        name: 'RegisterUser',
        components: {ValidationObserver, ValidationProvider},
        data() {
            return {
                reg: {},
                error: false,
                errorMessage: null,
                errorDetails: [],
            };
        },
        methods: {
            save() {
                axios.post('api/user', this.reg).then(() => {
                    this.$router.push({name: 'register'});
                    EventBus.$emit('success', 'Inr Benutzeraccount wurde angelegt.');
                }).catch(error => {
                    this.error = true;

                    console.log(error.response);

                    this.errorMessage = error.response.data.message;
                    this.errorDetails = error.response.data.errors;
                });
            }
        },
        mounted() {
            this.error = false;
        }
    };
</script>

<style scoped>

</style>
