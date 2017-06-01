import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const state = {
  targetRoute: 'user'
}

const mutations = {
  changeRoute (state, target) {
    state.targetRoute = target
  }
}

export default new Vuex.Store({
  state,
  mutations
})
