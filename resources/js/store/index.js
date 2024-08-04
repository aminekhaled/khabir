// import { createStore } from "vuex"

// const store = createStore({
//     state () {
//       return {
//         count: 0
//       }
//     },
//     mutations: {
//       increment (state) {
//         state.count++
//       }
//     }
// })


// export default store;


import { createStore } from 'vuex'
import axios from 'axios'

const store = createStore({
  state() {
    return {
      count: null,
    }
  },
  mutations: {
    async setUserCartCoursesCount(state, count) {
      const response = await axios.get('api/cart/get-user-cart-courses-number', {
        headers: {
            Authorization: `Bearer ${localStorage.token}`
        }
    });
      state.count = response.data.cart_courses_number;
    },
  },
  actions: {
    async fetchInitialCount({ commit }) {
      try {
        const response = await axios.get('api/cart/get-user-cart-courses-number');
        commit('setUserCartCoursesCount', response.data.cart_courses_number);
      } catch (error) {
        console.error('Failed to fetch initial count:', error);
      }
    }
  }
})

export default store;


