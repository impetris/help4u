<template>
    <div>

        <div class="tw-container tw-bg-teal-500 tw-w-full tw-shadow-lg tw-p-10 tw-mx-auto tw-my-8 tw-bg-center tw-bg-right" style="background-image: url('/img/network.png')">
            <div class="tw-text-2xl md:tw-text-4xl tw-text-white tw-font-bold md:tw-font-light tw-m-4 tw-py-8 tw-w-full md:tw-w-1/2 tw-tracking-wide tw-leading-loose">
                In Zeiten von <strong class="tw-underline">#COVOID19</strong> einfache und schnelle Hilfe von <span class="tw-underline">Freiwilligen</span> für Personen die <span
                class="tw-underline">Hilfe</span> benötigen.
            </div>
        </div>

        <div class="tw-container tw-mx-auto">
            <div class="tw-flex tw-flex-wrap tw-text-2xl tw-mt-8">
                <div class="tw-w-full md:tw-w-1/2 tw-mb-2 md:tw-mb-0">
                    <router-link :to="{name: 'help'}">
                        <div class="tw-py-6 tw-mx-8 tw-text-center tw-bg-blue-700 tw-text-white tw-rounded-lg hover:tw-shadow-lg hover:tw-bg-blue-800 tw-cursor-pointer">
                            Ich benötige Hilfe
                        </div>
                    </router-link>
                </div>
                <div class="tw-w-full md:tw-w-1/2">
                    <router-link :to="{name: 'register'}">
                        <div class="tw-py-6 tw-mx-8 tw-text-center tw-border-2 tw-rounded-lg hover:tw-shadow-lg tw-cursor-pointer tw-text-black">Ich kann Helfen</div>
                    </router-link>
                </div>
            </div>
        </div>

        <div class="tw-container tw-mx-auto">
            <div class="tw-p-8 tw-mt-10">
                <div class="tw-text-xl tw-font-bold tw-mb-4">Wie es funktioniert</div>
                <p class="tw-text-lg">
                    Schnelle Hilfe finden in ihrer Nähe<br>
                    Sie werden durch den Registrierungsprozess geführt.
                </p>
                <p>
                    <strong>Hilfe anbieten</strong><br>
                    Geben sie an zu welchem Thema sie Hilfe anbieten, hinterlegen sie ihre Adresse, Telefonnummer und/oder Email und den Zeitraum, wo sie Hilfe anbieten wollen.
                    Anfragen werden dann über HELP4U an Sie weitergeleitet.
                </p>
                <p>
                    <strong>Hilfe benötigen</strong><br>
                    Geben sie an zu welchem in welchem Bereich sie Hilfe benötigen, und wo Sie diese Benötigen. HELP4U sucht dann automatisch nach Personen die in Ihrer nähe sind
                    und diese Hilfe anbieten können die Sie benötigen. Diese setzen sich dann mit Ihnen direkt in verbindung.
                </p>
                <p>
                    <strong>Die gesamte Dienstleitung von HELP4U ist für alle kostenlos.</strong>
                </p>
            </div>
        </div>

        <div class="tw-w-full tw-bg-gray-200">
            <div class="tw-container tw-mx-auto">
                <div class="tw-p-8 tw-mt-10">
                    <div class="tw-text-xl tw-font-bold tw-mb-4">COVID19 Informationen</div>

                    <div>
                        <a href="https://bag-coronavirus.ch/" target="_blank">
                            <img src="/img/covid/save-de-1.png" class="tw-h-48 tw-inline-block">
                            <img src="/img/covid/plakat-bag.png" class="tw-h-48 tw-inline-block">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-w-full tw-bg-gray-400">
            <div class="tw-container tw-mx-auto tw-pt-4 tw-pb-8 tw-px-8">
                <div class="d-inline-block tw-align-top md:tw-mr-8">
                    <div>
                        <div class="my-4">Konzeption & Realisierung</div>
                        <a href="https://impetris.ch" target="_blank">
                            <img class="tw-h-16" src="/img/sponsor/impetris_colour_trans_bg.png">
                        </a>
                    </div>
                </div>
                <div class="d-inline-block mt-4">
                    <div id="twitter-container"></div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'Home',
        mounted() {
            twttr.widgets.createTimeline(
                {
                    sourceType: 'profile',
                    screenName: 'Help4uCh',
                    theme: 'light',
                },
                document.getElementById("twitter-container"),
                {
                    tweetLimit: 1,
                    chrome: 'noheader, nofooter, noscrollbar',
                },
            );
        }
    };
</script>

<style scoped>

</style>
