const state = {
    loaded: false,
    user: {},
};

// getters
const getters = {
    user: state => state.user,
    isLoggedIn: state => !_.isEmpty(state.user),
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
        state.user = {};
        state.loaded = false;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
