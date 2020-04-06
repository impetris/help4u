<template>
    <div class="tw-container tw-mx-auto">
        <div class="tw-m-16">

            <v-alert type="error" border="left" :value="user.person_id === null">
                <span class="hidden">{{ $t('Inquiry.noProfile') }}</span>
                Sie haben noch kein Helfer Profil. Legen Sie sich
                <router-link :to="{name:'profile.person'}">hier</router-link>
                eines an.
            </v-alert>

            <div class="tw-border-b tw-border-gray-400 tw-text-2xl tw-font-thin">
                {{ $t('Inquiry.title') }}
            </div>

            <v-alert type="info" border="left">
                {{ $t('Inquiry.infoText') }}
            </v-alert>

            <v-data-iterator
                :items="items"
                :items-per-page="1000"
                hide-default-footer
            >
                <template v-slot:default="props">
                    <v-row>
                        <v-col v-for="item in props.items" :key="item.name" cols="12">
                            <v-card>
                                <v-card-title>
                                    {{ item.enquirer.first_name }} {{ item.enquirer.last_name }}
                                    <v-spacer></v-spacer>
                                </v-card-title>
                                <v-card-text>
                                    {{ item.enquirer.address }}, {{ item.enquirer.zip }} {{ item.enquirer.place }}<br>
                                    {{ item.enquirer.email }} {{ item.enquirer.phone }}
                                </v-card-text>
                                <v-card-actions>
                                    <v-chip color="indigo" text-color="white" class="mr-2">
                                        <v-avatar left>
                                            <v-icon>mdi-star</v-icon>
                                        </v-avatar>
                                        {{ item.enquirer.category_id | categoryLabel }}
                                    </v-chip>
                                    <v-chip color="green" text-color="white">
                                        <v-avatar left>
                                            <v-icon>mdi-clock</v-icon>
                                        </v-avatar>
                                        {{ item.enquirer.time_id | timeLabel }}
                                    </v-chip>
                                    <v-spacer></v-spacer>
                                    <div v-if="!item.status" class="tw-inline-block">
                                        <v-btn color="grey" outlined small tile @click="decline(item)">{{ $t('OneWord.decline') }}</v-btn>
                                        <v-btn color="primary" small tile @click="accept(item)">{{ $t('OneWord.accept') }}</v-btn>
                                    </div>
                                    <div v-else-if="item.status === 1">{{ $t('OneWord.accepted') }}</div>
                                </v-card-actions>
                            </v-card>
                        </v-col>
                    </v-row>
                </template>
                <template v-slot:no-data>
                    <v-alert type="warning" outlined>
                        {{ $t('Inquiry.noData') }}
                    </v-alert>
                </template>
            </v-data-iterator>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: 'Inquiries',
        data() {
            return {
                items: [],
            };
        },
        computed: {
            ...mapGetters('user', {
                user: 'user',
            }),
        },
        filters: {
            categoryLabel(value) {
                switch (value) {
                    case 1:
                        return 'Einkaufen';
                    case 2:
                        return 'Kochen';
                    case 3:
                        return 'Transport';
                    case 4:
                        return 'Garten';
                    case 5:
                        return 'Ernte';
                }
            },
            timeLabel(value) {
                switch (value) {
                    case 1:
                        return 'Ganztags';
                    case 2:
                        return 'Morgens';
                    case 3:
                        return 'Mittags';
                    case 4:
                        return 'Abends';
                    case 5:
                        return 'Nachts';
                }
            },
        },
        methods: {
            load() {
                axios.get('/api/inquiries').then((response) => {
                    this.items = response.data.data;
                });
            },
            accept(item) {
                axios.put(`/api/inquiries/${item.id}`, {status: 1}).then(() => {
                    this.load();
                });
            },
            decline(item) {
                axios.put(`/api/inquiries/${item.id}`, {status: 2}).then(() => {
                    this.load();
                });
            },
        },
        mounted() {
            this.load();
        },
    };
</script>

<style scoped>

</style>
