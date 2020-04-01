import { extend } from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';

import { localize } from 'vee-validate';
import de from 'vee-validate/dist/locale/de';

localize('de', de);

Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule]);
});
