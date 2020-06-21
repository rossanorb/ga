import api from './../../api/student';

const state = {
    students: []
};

const getters = {};

const mutations = {
    setStudents(state, students) {
        state.students = students;
    }
};

const actions = {
    list({ commit, dispatch }) {
        api.list()
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
