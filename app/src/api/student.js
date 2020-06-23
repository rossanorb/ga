import axios from 'axios';
const apiBaseUrl = 'http://localhost:9001/api/students';

export default {
    async list(id) {
        try {
            return await axios.get(`${apiBaseUrl}`)
                .then((response) => {
                    return {
                        status: true,
                        result: response.data.data
                    };
                })
                .catch(err => {
                    return {
                        status: false,
                        error: err.message,
                        description: err.response.data.message
                    };
                });
        } catch (error) {
            return {
                status: false,
                error: error,
                description: null
            };
        }
    },

    async find(id) {
        try {
            return await axios.get(`${apiBaseUrl}/${id}`)
                .then((response) => {
                    return {
                        status: true,
                        result: response.data
                    };
                })
                .catch(err => {
                    return {
                        status: false,
                        error: err.message,
                        description: err.response.data.message
                    };
                });
        } catch (error) {
            return {
                status: false,
                error: error,
                description: null
            };
        }
    },

    async create(student) {
        try {
            return await axios.post(`${apiBaseUrl}`, student)
                .then((response) => {
                    return {
                        status: true,
                        result: response.data
                    };
                })
                .catch(err => {
                    return {
                        status: false,
                        error: err.message,
                        description: err.response.data.message
                    };
                });
        } catch (error) {
            return {
                status: false,
                error: error,
                description: null
            };
        }
    },

    async update(params) {
        try {
            return await axios.put(`${apiBaseUrl}/${params.id}`, params.form)
                .then((response) => {
                    return {
                        status: true,
                        result: response.data
                    };
                })
                .catch(err => {
                    return {
                        status: false,
                        error: err.message,
                        description: err.response.data.message
                    };
                });
        } catch (error) {
            return {
                status: false,
                error: error,
                description: null
            };
        }
    }
};
