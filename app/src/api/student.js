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
    }
};
