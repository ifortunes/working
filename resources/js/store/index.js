import Vuex from 'vuex'

import advertisements from './advertisement'

// Vue.use(Vuex)

const store = new Vuex.Store({
    modules: {
        advertisements:advertisements
    }
})

export default store
