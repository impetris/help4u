<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-8 md:tw-m-16">

            <ValidationObserver v-slot="{handleSubmit}">

                <v-form>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('RegisterUser.title') }}
                    </div>

                    <div class="tw-m-0 md:tw-m-8">

                        <v-alert :value="error" color="error" border="left" dismissible>
                            <strong>{{ errorMessage }}</strong>

                            <ul v-if="errorDetails" class="tw-list-disc mt-2">
                                <li v-for="(value, propertyName) in errorDetails">{{ value[0] }}</li>
                            </ul>
                        </v-alert>

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|email" :name="$t('OneWord.email')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.email"
                                        type="email"
                                        :label="$t('OneWord.email')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|min:8|max:255" :name="$t('OneWord.password')" vid="confirm" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.password"
                                        type="password"
                                        :label="$t('OneWord.password')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|min:8|max:255" :name="$t('OneWord.passwordConfirm')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.password_confirmation"
                                        type="password"
                                        :label="$t('OneWord.passwordConfirm')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>

                        <div class="tw-text-right">
                            <v-btn x-large color="primary" @click="handleSubmit(save)">{{ $t('OneWord.save') }}</v-btn>
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
    import {mapGetters} from 'vuex';

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
        computed: {
            ...mapGetters('user', {
                locale: 'locale',
            }),
        },
        methods: {
            save() {
                let reg = this.reg;
                reg['locale'] = this.locale;

                axios.post('api/user', reg).then(() => {
                    EventBus.$emit('logged-in', {redirect: {name: 'register'}});
                    EventBus.$emit('success', this.$t('RegisterUser.success'));
                }).catch(error => {
                    this.error = true;

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
