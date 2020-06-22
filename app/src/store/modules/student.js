import api from './../../api/student';

const state = {
    students: [],
    response: {}
};

const getters = {
    response: (state) => {
        console.log(state.response);
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
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
