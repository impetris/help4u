<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-4 md:tw-m-16">

            <ValidationObserver v-slot="{handleSubmit}">

                <v-form>

                    <v-alert type="info" border="left" outlined v-html="$t('Person.missingInfoText')"></v-alert>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('Person.infoText') }}
                    </div>

                    <div class="tw-m-2 md:tw-m-8">
                        <v-row>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.categories" :value="1" :label="$t('Help.category.1')"></v-checkbox>
                                <v-checkbox v-model="reg.categories" :value="2" :label="$t('Help.category.2')"></v-checkbox>
                                <v-checkbox v-model="reg.categories" :value="3" :label="$t('Help.category.3')"></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.categories" :value="4" :label="$t('Help.category.4')"></v-checkbox>
                                <v-checkbox v-model="reg.categories" :value="5" :label="$t('Help.category.5')"></v-checkbox>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('Person.time.infoText') }}
                    </div>

                    <div class="tw-m-2 md:tw-m-8">

                        <v-alert type="info" border="left">
                            {{ $t('Person.timeHelpText') }}
                        </v-alert>

                        <v-row>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.times" :value="1" :label="$t('Help.time.1')"></v-checkbox>
                                <v-checkbox v-model="reg.times" :value="2" :label="$t('Help.time.2')"></v-checkbox>
                                <v-checkbox v-model="reg.times" :value="3" :label="$t('Help.time.3')"></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.times" :value="4" :label="$t('Help.time.4')"></v-checkbox>
                                <v-checkbox v-model="reg.times" :value="5" :label="$t('Help.time.5')"></v-checkbox>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('Person.contactText') }}
                    </div>

                    <div class="tw-m-2 md:tw-m-8">

                        <v-row>
                            <v-col cols="12" md="6">
                                <validation-provider rules="required|max:255" :name="$t('OneWord.firstName')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.first_name"
                                        type="text"
                                        :label="$t('OneWord.firstName')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="12" md="6">
                                <validation-provider rules="required|max:255" :name="$t('OneWord.lastName')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.last_name"
                                        type="text"
                                        :label="$t('OneWord.lastName')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <validation-provider rules="required|max:255" :name="$t('OneWord.address')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.address"
                                        type="text"
                                        :label="$t('OneWord.address')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="4">
                                <validation-provider rules="required|max:255" :name="$t('OneWord.zip')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.zip"
                                        type="text"
                                        :label="$t('OneWord.zip')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="8">
                                <validation-provider rules="required|max:255" :name="$t('OneWord.place')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.place"
                                        type="text"
                                        :label="$t('OneWord.place')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <validation-provider rules="required|max:255|phone" :name="$t('OneWord.phone')" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.phone"
                                        type="email"
                                        :label="$t('OneWord.phone')"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="tw-text-right">
                        <v-btn x-large color="primary" @click="handleSubmit(save)">{{ $t('OneWord.save') }}</v-btn>
                    </div>

                </v-form>

            </ValidationObserver>

        </div>
    </div>
</template>

<script>
    import {extend, ValidationObserver, ValidationProvider} from 'vee-validate';
    import {EventBus} from '../event-bus';
    import PhoneNumber from 'awesome-phonenumber';

    export default {
        name: 'Person',
        components: {extend, ValidationObserver, ValidationProvider},
        data() {
            return {
                reg: {
                    categories: [],
                    times: [],
                },
            };
        },
        computed: {
        },
        methods: {
            save() {
                axios.put(`/api/people/${this.reg.id}`, this.reg).then(() => {
                    EventBus.$emit('success', this.$t('Person.success'));
                });
            },
            load() {
                axios.get('api/person').then((response) => {
                    this.reg = response.data.data;
                }).catch(() => {
                    this.$router.push({name: 'register'});
                    EventBus.$emit('success', this.$t('Inquiry.noProfile'));
                });
            },
        },
        mounted() {
            this.load();
            let that = this;

            extend('phone', {
                message (fieldName) {
                    return that.$t('Validation.error.phone', {phone: fieldName});
                },
                validate (value) {
                    return new Promise(resolve => {
                        let phone = new PhoneNumber(value, 'CH');
                        resolve({ valid: phone.isValid() })
                    });
                }
            });
        }
    };
</script>

<style scoped>

</style>
