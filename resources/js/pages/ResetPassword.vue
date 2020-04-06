<template>
    <div class="tw-container tw-mx-auto tw-p-8">

        <ValidationObserver v-slot="{handleSubmit}">
            <v-form>

                <v-card>
                    <v-card-text>

                        <validation-provider rules="required|email" name="Email" v-slot="{errors}">
                            <v-text-field
                                v-model="email"
                                type="email"
                                label="Email Adresse"
                                required
                                :error-messages="errors"
                            ></v-text-field>
                        </validation-provider>

                    </v-card-text>
                    <v-card-actions class="pa-4">
                        <v-spacer></v-spacer>
                        <v-btn x-large color="primary" @click.once="handleSubmit(send)">{{ $t('OneWord.resetPassword') }}</v-btn>
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
        name: 'ResetPassword',
        components: {ValidationObserver, ValidationProvider},
        data() {
            return {
                email: null,
                sent: false,
                loading: false,
            };
        },
        methods: {
            send() {
                this.loading = true;

                axios.post('/password/email', {email: this.email}).then(() => {
                    EventBus.$emit('success', this.$t('ResetPassword.success'));
                    this.sent = true;
                }).finally(() => {
                    this.loading = false;
                });
            },
        },
    };
</script>

<style scoped>

</style>
