import axios from 'axios';

const employee = {
    namespaced: true,
    state: {
        employees: [],
    },
    mutations: {
        setEmployees (state, data) {
            state.employees = data;
        },
    },
    actions: {
        fetchEmployees (context) {
            return axios.get('http://localhost/api/employees').then(function (data) {
                context.commit('setEmployees', Object.values(data.data.data));
            });
        },
        addEmployee (context, data) {
            return axios.post('http://localhost/api/employees', data).then(function () {
            });
        },
        editEmployee (context, item) {
            return axios.put('http://localhost/api/employees/'+item.id, item).then(function () {
            });
        },
        deleteEmployee (context, item) {
            return axios.delete('http://localhost/api/employees/'+item.id).then(function () {
            });
        },
    }
};

export default employee;
