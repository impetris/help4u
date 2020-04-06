import _ from 'lodash';

const state = {
    loaded: false,
    user: {
        locale: 'de-CH',
    },
};

// getters
const getters = {
    user: state => state.user,
    isLoggedIn: state => _.has(state.user, 'email'),
    locale: state => _.get(state.user, 'locale', 'de-CH'),
};

// actions
const actions = {
    load({state, commit}) {
        if (!state.loaded) {
            return axios.get('/api/user').then(response => {
                commit('load', response.data.data);
            });
        }
    },
    set({state, commit}, user) {
        commit('set', user);
    },
    update({state, commit}, user) {
    },
    logout({state, commit}) {
        return axios.post('/logout').then(response => {
            commit('logout');
        });
    },
    setLocale({state, commit}, locale) {
        commit('setLocale', locale)
    },
};

// mutations
const mutations = {
    load(state, data) {
        state.user = data;
        state.load = true;
    },
    set(state, user) {
        state.user = user;
    },
    update(state, user) {
        state.user = user;
    },
    logout(state) {
        let oldLocale = state.user.locale;
        state.user = {
            locale: oldLocale,
        };
        state.loaded = false;
    },
    setLocale(state, locale) {
        console.log(locale);
        state.user.locale = locale;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
