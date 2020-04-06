<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-8 md:tw-m-16">

            <ValidationObserver v-slot="{handleSubmit}">

                <v-form>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('Help.infoText') }}
                    </div>

                    <div class="tw-m-4 md:tw-m-8">
                        <v-radio-group v-model="reg.category_id" :mandatory="true">
                            <v-row>
                                <v-col cols="6">
                                    <v-radio :value="1" :label="$t('Help.category.1')"></v-radio>
                                    <v-radio :value="2" :label="$t('Help.category.2')"></v-radio>
                                    <v-radio :value="3" :label="$t('Help.category.3')"></v-radio>
                                </v-col>
                                <v-col cols="6">
                                    <v-radio :value="4" :label="$t('Help.category.4')"></v-radio>
                                    <v-radio :value="5" :label="$t('Help.category.5')"></v-radio>
                                </v-col>
                            </v-row>
                        </v-radio-group>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('Help.time.infoText') }}
                    </div>

                    <div class="tw-m-4 md:tw-m-8">
                        <v-radio-group v-model="reg.time_id" :mandatory="true">
                            <v-row>
                                <v-col cols="6">
                                    <v-radio :value="1" :label="$t('Help.time.1')"></v-radio>
                                    <v-radio :value="2" :label="$t('Help.time.2')"></v-radio>
                                    <v-radio :value="3" :label="$t('Help.time.3')"></v-radio>
                                </v-col>
                                <v-col cols="6">
                                    <v-radio :value="4" :label="$t('Help.time.4')"></v-radio>
                                    <v-radio :value="5" :label="$t('Help.time.5')"></v-radio>
                                </v-col>
                            </v-row>
                        </v-radio-group>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        {{ $t('Help.contact.infoText') }}
                    </div>

                    <div class="tw-m-4 md:tw-m-8">

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
                                <validation-provider rules="max:255" :name="$t('OneWord.phone')" v-slot="{errors}">
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
                        <v-btn x-large color="primary" @click.once="handleSubmit(save)" :disabled="submitted" :loading="loading">{{ $t('OneWord.save') }}</v-btn>
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
        components: {ValidationObserver, ValidationProvider},
        name: 'Help',
        data() {
            return {
                reg: {},
                submitted: false,
                loading: false,
            };
        },
        methods: {
            save() {
                this.loading = true;

                axios.post('/api/help-search', this.reg).then(() => {
                    this.submitted = true;
                    EventBus.$emit('success', this.$t('Help.success'));
                }).finally(() => {
                    this.loading = false;
                });
            },
        }
    };
</script>

<style scoped>

</style>
