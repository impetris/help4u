import { extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';

import { localize } from 'vee-validate';
import de from 'vee-validate/dist/locale/de';
import it from 'vee-validate/dist/locale/it';
import {EventBus} from '../event-bus';

localize('de', de);

EventBus.$on('change-locale', (locale) => {
    if (locale === 'it-CH') {
        localize('it', it);
    } else {
        localize('de', de);
    }
});

Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});
