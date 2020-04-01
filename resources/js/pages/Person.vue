<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-16">

            <ValidationObserver v-slot="{handleSubmit}">

                <v-form>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Wo können Sie helfen?
                    </div>

                    <div class="tw-m-8">
                        <v-row>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.categories" :value="1" label="Einkaufen"></v-checkbox>
                                <v-checkbox v-model="reg.categories" :value="2" label="Kochen"></v-checkbox>
                                <v-checkbox v-model="reg.categories" :value="3" label="Transport"></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.categories" :value="4" label="Garten"></v-checkbox>
                                <v-checkbox v-model="reg.categories" :value="5" label="Ernte"></v-checkbox>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Wann können Sie helfen?
                    </div>

                    <div class="tw-m-8">
                        <v-row>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.times" :value="1" label="Ganztags"></v-checkbox>
                                <v-checkbox v-model="reg.times" :value="2" label="Morgens"></v-checkbox>
                                <v-checkbox v-model="reg.times" :value="3" label="Mittgags"></v-checkbox>
                            </v-col>
                            <v-col cols="6">
                                <v-checkbox v-model="reg.times" :value="4" label="Abends"></v-checkbox>
                                <v-checkbox v-model="reg.times" :value="5" label="Nachts"></v-checkbox>
                            </v-col>
                        </v-row>
                    </div>

                    <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                        Wie können Sie erreicht werden?
                    </div>

                    <div class="tw-m-8">

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
    import {EventBus} from '../event-bus';

    export default {
        name: 'Person',
        components: {ValidationObserver, ValidationProvider},
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
                    EventBus.$emit('success', 'Ihr Profil wurde erfolgreich aktualisiert.');
                });
            },
            load() {
                axios.get('api/person').then((response) => {
                    this.reg = response.data.data;
                }).catch(() => {
                    this.$router.push({name: 'register'});
                    EventBus.$emit('success', 'Sie haben noch kein Helfer Profil. Legen Sie sich mit dem untenstehenden  Formular eines an.');
                });
            },
        },
        mounted() {
            this.load();
        }
    };
</script>

<style scoped>

</style>
