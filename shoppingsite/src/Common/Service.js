import axios from 'axios';
import { MAIN_URL } from '@/Common/Url';
export function userLogin(data) {
    return axios.post(`${MAIN_URL}login`, data)
}
export function userRegister(data) {
    return axios.post(`${MAIN_URL}register`, data)
}
export function userContactus(data) {
    return axios.post(`${MAIN_URL}contactus`, data)
}
export function categories() {
    return axios.get(`${MAIN_URL}categories`)
}
export function products() {
    return axios.get(`${MAIN_URL}products`)
}
export function product(id) {
    return axios.get(`${MAIN_URL}product/${id}`)
}
export function CategoryProducts(id) {
    return axios.get(`${MAIN_URL}category/${id}`)
}
export function SubCategoryProducts(id) {
    return axios.get(`${MAIN_URL}subcategory/${id}`)
}
export function changePassword(data) {
    var token = localStorage.getItem('token');
    return axios.post(`${MAIN_URL}changepassword`, data, { headers: { "Authorization": `Bearer ${token}` } })
}
export function profile(id) {
    var token = localStorage.getItem('token');
    return axios.get(`${MAIN_URL}profile/${id}`, { headers: { "Authorization": `Bearer ${token}` } })
}
export function editProfile(data) {
    var token = localStorage.getItem('token');
    return axios.post(`${MAIN_URL}editprofile`, data, { headers: { "Authorization": `Bearer ${token}` } })
}
export function coupons() {
    return axios.get(`${MAIN_URL}coupons`)
}
export function logoutuser() {
    return axios.post(`${MAIN_URL}logout`)
}
export function applycoupon(data) {
    return axios.post(`${MAIN_URL}applycoupon`, data)
}
export function orderplaced(data) {
    return axios.post(`${MAIN_URL}placeorder`, data)
}
export function AddToWishlist(data) {
    return axios.post(`${MAIN_URL}addtowishlist`, data)
}
export function wishlistproduct(id) {
    return axios.get(`${MAIN_URL}wishlistproduct/${id}`)
}
export function DeleteItem(data) {
    return axios.post(`${MAIN_URL}deletewishlistitem`, data)
}
export function MyOrders(id) {
    return axios.get(`${MAIN_URL}myorders/${id}`)
}
export function cmsaddress() {
    return axios.get(`${MAIN_URL}cmsaddress`)
}
export default { userLogin, userRegister, userContactus, categories, products, product, SubCategoryProducts, changePassword, profile };