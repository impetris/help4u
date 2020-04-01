<template>
    <v-snackbar
        v-model="snackbar"
        multi-line
        :color="color"
        top
    >
        {{ text }}
        <v-btn
            color="white"
            text
            @click="snackbar = false"
        >
            Schliessen
        </v-btn>
    </v-snackbar>
</template>

<script>
    import {EventBus} from '../event-bus';

    export default {
        name: 'TopSnackbar',
        data() {
            return {
                color: 'red darken-2',
                text: null,
                snackbar: false,
            };
        },
        mounted() {
            EventBus.$on('success', message => {
                this.text = message;
                this.snackbar = true;
                this.color = 'green darken-2';
            });
            EventBus.$on('error', message => {
                this.text = message;
                this.snackbar = true;
            });
        }
    };
</script>

<style scoped>

</style>
