import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);
export default new Vuex.Store({
    state: {
        inCart: JSON.parse(localStorage.getItem('myCart')) ? JSON.parse(localStorage.getItem('myCart')) : [],
        user: JSON.parse(localStorage.getItem('user')) ? JSON.parse(localStorage.getItem('user')) : [],
        coupon: JSON.parse(localStorage.getItem('coupon')) ? JSON.parse(localStorage.getItem('coupon')) : [],
    },
    getters: {
        inCart: state => state.inCart,
        user: state => state.user,
        coupon: state => state.coupon
    },
    mutations: {
        ADD_TO_CART(state, id, pname, image, price, pquantity, description) { state.inCart.push(id, pname, image, price, pquantity, description) },
        ADD_USER_INFO(state, info) { state.user.push(info) },
        DELETE_ITEM(state, item) {
            let index = state.inCart.indexOf(item);
            state.inCart.slice(index, 1)
        },
        COUPON_APPLIED(state, coupon) {
            state.coupon.push(coupon);
        }
    },
    actions: {
        addToCart(context, id, pname, image, price, pquantity, description) { context.commit('ADD_TO_CART', id, pname, image, price, pquantity, description) },
        userInfo(context, info) { context.commit('ADD_USER_INFO', info) },
        deleteItem(context, item) { context.commit('DELETE_ITEM', item) },
        couponApplied(context, coupon) { context.commit('COUPON_APPLIED', coupon) }
    }
})