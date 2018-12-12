import Vue from 'vue'
import Vuex from 'vuex'
// import VuexPersist from 'vuex-persist'
// import { builtinModules } from 'module';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    machine: {}
  },
  mutations: {
    setMachine(state, machine) {
      state.machine =  machine;
    },
    setCount(state, count) {
      state.machine.count_id = count.id;
      state.machine.count =  count;
    }
  }
})
