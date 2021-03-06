import api from './../../api/student';

const state = {
    students: [],
    response: {}
};

const getters = {
    response: (state) => {
        return state.response;
    }
};

const mutations = {
    setStudents(state, students) {
        state.students = students;
    },
    setResponse(state, response) {
        state.response = response;
    }
};

const actions = {
    list({ commit }) {
        api.list()
            .then(students => {
                if (students.status) {
                    commit('setStudents', students.result);
                }
            });
    },
    create({ commit }, student) {
        api.create(student)
            .then(response => {
                commit('setResponse', response);
            });
    },
    find({ commit }, id) {
        api.find(id)
            .then(response => {
                commit('setResponse', response);
            });
    },
    update({ commit }, params) {
        api.update(params)
            .then(response => {
                commit('setResponse', response);
            });
    },
    delete({ commit }, id) {
        api.delete(id)
            .then(response => {
                commit('setResponse', response);
            });
    },
    filter({ commit }, queryString) {
        console.log(queryString);
        api.list(queryString)
            .then(students => {
                if (students.status) {
                    commit('setStudents', students.result);
                }
            });
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
