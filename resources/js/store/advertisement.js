import { createStore } from 'vuex'

export default createStore({
    namespaced: true,
    state: {
        advertisements: [],
        pagination: {
            current_page: 1,
            per_page: 1,
            last_page: 1,
            total: 0
        }
    },

    getters: {
        advertisements: (state) => state.advertisements,
        pagination: (state) => state.pagination,
    },

    mutations: {
        MUTATION_ADVERTISEMENTS: (state, data) => {
            state.advertisements = data;
        },
        MUTATION_PAGINATION: (state, data) => {
            state.pagination = data;
        },
    },

    actions: {
        SET_ADVERTISEMENT({ commit}, data) {
            axios.post('/api/v1/advertisements', data)
                .then(response => {
                    // console.log(response.data)
                }).catch(({response:{data}}) => {
                commit('MUTATION_ERRORS', data);
                console.log(data)
            });
        },
        GET_ADVERTISEMENTS({commit}, data) {
            axios.get(`/api/v1/advertisements?page=${data.page}${data.query}`)
                .then(response => {
                    console.log(response.data)
                    commit('MUTATION_PAGINATION', {
                        current_page: response.data.meta.current_page,
                        per_page: response.data.meta.current_page,
                        last_page: response.data.meta.last_page,
                        total: response.data.meta.current_page
                    });

                    commit('MUTATION_ADVERTISEMENTS', response.data.data);

                }).catch((error) => {
                    console.log(error)
                });
        },
    },
});
