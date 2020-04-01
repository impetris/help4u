<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-16">

            <ValidationObserver v-slot="{handleSubmit}">

                <v-form>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Wo benötigen Sie Hilfe?
                    </div>

                    <div class="tw-m-8">
                        <v-radio-group v-model="reg.category_id" :mandatory="true">
                            <v-row>
                                <v-col cols="6">
                                    <v-radio :value="1" label="Einkaufen"></v-radio>
                                    <v-radio :value="2" label="Kochen"></v-radio>
                                    <v-radio :value="3" label="Transport"></v-radio>
                                </v-col>
                                <v-col cols="6">
                                    <v-radio :value="4" label="Garten"></v-radio>
                                    <v-radio :value="5" label="Ernte"></v-radio>
                                </v-col>
                            </v-row>
                        </v-radio-group>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Wann benötigen Sie Hilfe?
                    </div>

                    <div class="tw-m-8">
                        <v-radio-group v-model="reg.time_id" :mandatory="true">
                            <v-row>
                                <v-col cols="6">
                                    <v-radio :value="1" label="Ganztags"></v-radio>
                                    <v-radio :value="2" label="Morgens"></v-radio>
                                    <v-radio :value="3" label="Mittgags"></v-radio>
                                </v-col>
                                <v-col cols="6">
                                    <v-radio :value="4" label="Abends"></v-radio>
                                    <v-radio :value="5" label="Nachts"></v-radio>
                                </v-col>
                            </v-row>
                        </v-radio-group>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Wie können Sie erreicht werden?
                    </div>

                    <div class="tw-m-8">

                        <v-row>
                            <v-col>
                                <validation-provider rules="required|email" name="Email" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.email"
                                        type="email"
                                        label="Email"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6">
                                <validation-provider rules="required|max:255" name="Vorname" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.first_name"
                                        type="text"
                                        label="Vorname"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="6">
                                <validation-provider rules="required|max:255" name="Nachname" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.last_name"
                                        type="text"
                                        label="Nachname"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <validation-provider rules="required|max:255" name="Adresse" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.address"
                                        type="text"
                                        label="Adresse"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="4">
                                <validation-provider rules="required|max:255" name="PLZ" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.zip"
                                        type="text"
                                        label="PLZ"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                            <v-col cols="8">
                                <validation-provider rules="required|max:255" name="Ort" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.place"
                                        type="text"
                                        label="Ort"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <validation-provider rules="max:255" name="Telefon" v-slot="{errors}">
                                    <v-text-field
                                        v-model="reg.phone"
                                        type="email"
                                        label="Telefon"
                                        required
                                        :error-messages="errors"
                                    ></v-text-field>
                                </validation-provider>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="tw-text-right">
                        <v-btn x-large color="primary" @click="handleSubmit(save)">Speichern</v-btn>
                    </div>

                </v-form>

            </ValidationObserver>

        </div>
    </div>
</template>

<script>
    import {ValidationObserver, ValidationProvider} from 'vee-validate';

    export default {
        components: {ValidationObserver, ValidationProvider},
        name: 'Help',
        data() {
            return {
                reg: {},
            };
        },
        methods: {
            save() {
                axios.post('/api/help-search', this.reg).then(() => {

                });
            },
        }
    };
</script>

<style scoped>

</style>
