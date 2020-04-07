<template>
    <div class="tw-container tw-mx-auto tw-my-8">

        <v-row>
            <v-col md="3" cols="12">

                <v-list>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="title py-2">{{ user.name }}</v-list-item-title>
                            <v-list-item-subtitle>{{ user.email }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-list nav dense>
                    <v-list-item-group color="primary">
                        <v-list-item link :to="{ path: '/profile/inquiries' }">
                            <v-list-item-icon>
                                <v-icon>mdi-table</v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title>{{ $t('Profile.nav.inquiries') }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link :to="{ path: '/profile/person' }">
                            <v-list-item-icon>
                                <v-icon>mdi-account</v-icon>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title>{{ $t('Profile.nav.myProfile') }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>

            </v-col>
            <v-col md="9" cols="12">
                <router-view></router-view>
            </v-col>
        </v-row>


    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: 'Profile',
        computed: {
            ...mapGetters('user', {
                user: 'user',
            }),
        },
        data() {
            return {};
        },
    };
</script>

<style scoped>

</style>
