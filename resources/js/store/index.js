import { createStore } from 'vuex';

export default createStore({
  state: {
    isAuthenticated: false,
  },
  mutations: {
    setAuthenticated(state, status) {
      state.isAuthenticated = status;
    },
  },
  actions: {
    actionLogin({ commit }) {
      commit('setAuthenticated', true);
    },
    actionLogout({ commit }) {
      commit('setAuthenticated', false);
    },
  },
  getters: {
    isAuthenticated: state => state.isAuthenticated,
  }
});