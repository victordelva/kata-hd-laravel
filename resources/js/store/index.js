import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    strict: debug,
    plugins: [createPersistedState()],
    state: {
        requests: [],
        floors: [],
    },
    mutations: {
        requests (state, requests) {
            state.requests = requests;
        },
        floors (state, floors) {
            state.floors = floors;
        }
    },
    actions: {
        fetchRequests (context) {
            return axios.get('/api/requests').then(function (data) {
                context.commit('requests', data.data);
            });
        },
        transform (context) {
            return axios.put('/api/sequences/all/transform').then(function (data) {
            });
        },
        turnOn (context) {
            return axios.put('/api/elevators/all/turn-on').then(function (data) {
            });
        },

        getStatus (context, id) {
            return axios.get('/api/elevators/'+id+'/status').then(function (data) {
                return data.data;
            });
        },

        fetchFloors (context) {
            return axios.get('/api/floors').then(function (data) {
                context.commit('floors', data.data);
            });
        },
    },
    getters: {
        findFloor: (state) => (id) => {
            return state.floors.find(floor => floor.id == id)
        }
    }
})
