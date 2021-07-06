
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({

    state: {
      application_id: ''
    },
    //showing things, not mutating state
    getters: {
      applicationId: state => {
        return state.application_id ;
      }
    },
    //mutating the state
    //mutations are always synchronous
    mutations: {
      //showing passed with payload, represented as num
      changeApplicationId: (state, id) => {
        state.application_id = id;
      }
    }, 
    actions: {
   
    }
  });