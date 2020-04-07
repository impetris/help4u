<template>
    <div>

        <div class="tw-container tw-bg-teal-500 tw-w-full tw-shadow-lg tw-pl-4 md:tw-pl-10 tw-p-10 tw-mx-auto tw-my-8 tw-bg-center md:tw-bg-right tw-bg-cover md:tw-bg-contain" style="background-image: url('/img/help4u.png')">
            <div class="tw-text-2xl md:tw-text-4xl tw-text-white tw-font-bold md:tw-font-light tw-m-4 tw-py-4 tw-w-3/4 md:tw-w-1/2 tw-tracking-wide tw-leading-loose">
                <span v-html="$t('Home.teaserText')"></span>
            </div>
        </div>

        <div class="tw-container tw-mx-auto">
            <div class="tw-flex tw-flex-wrap tw-text-2xl tw-mt-8">
                <div class="tw-w-full md:tw-w-1/2 tw-mb-2 md:tw-mb-0">
                    <router-link :to="{name: 'help'}">
                        <div class="tw-py-6 tw-mx-8 tw-text-center tw-bg-blue-700 tw-text-white tw-rounded-lg hover:tw-shadow-lg hover:tw-bg-blue-800 tw-cursor-pointer">
                            {{ $t('Home.requestHelp') }}
                        </div>
                    </router-link>
                </div>
                <div class="tw-w-full md:tw-w-1/2">
                    <router-link :to="{name: 'register'}">
                        <div class="tw-py-6 tw-mx-8 tw-text-center tw-border-2 tw-rounded-lg hover:tw-shadow-lg tw-cursor-pointer tw-text-black">
                            {{ $t('Home.provideHelp') }}
                        </div>
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
                    Geben sie an, zu welchem Bereich sie Hilfe benötigen und wo diese benötigt wird. HELP4U sucht dann automatisch nach Personen die in Ihrer Nähe sind,
                    und diese Hilfe anbieten können die Sie benötigen. Diese setzen sich dann mit Ihnen direkt in Verbindung.
                </p>
                <p>
                    <strong>Die gesamte Dienstleistung von HELP4U ist für alle kostenlos.</strong>
                </p>
            </div>
        </div>

        <div class="tw-w-full tw-bg-gray-200">
            <div class="tw-container tw-mx-auto">
                <div class="tw-p-8 tw-mt-10">
                    <div class="tw-text-xl tw-font-bold tw-mb-4">{{ $t('Home.covidInfo') }}</div>

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
                    <div class="tw-inline-block tw-mr-8">
                        <div class="my-4">{{ $t('Home.partner.concept') }}</div>
                        <a href="https://impetris.ch" target="_blank">
                            <img class="tw-h-16" src="/img/sponsor/impetris_colour_trans_bg.png">
                        </a>
                    </div>
                    <div class="tw-inline-block">
                        <div class="my-4">{{ $t('Home.partner.images') }}</div>
                        <a href="https://diexperten.ch" target="_blank">
                            <img class="tw-h-16" src="/img/sponsor/diexperten.png">
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
