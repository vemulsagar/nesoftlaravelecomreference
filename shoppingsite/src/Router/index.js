import Vue from 'vue';
import Router from 'vue-router';
Vue.use(Router);
import Home from '../components/Home';
import Contact from '../components/Contact';
import Login from '../components/Login';
import Cart from '../components/Cart';
import Product from '../components/Product';
import ProductDetails from '../components/ProductDetails';
import SubCategoryProducts from '../components/SubCategoryProducts';
import UserInfo from '../components/UserInfo';
import EditProfile from '../components/EditProfile';
import ChangePassword from '../components/ChangePassword';
import Checkout from '../components/Checkout';
import Wishlist from '../components/Wishlist';
import MyOrders from '../components/MyOrders';
import Shop from '../components/Shop';
// import swal from 'sweetalert2'; 
// import VueSweetalert2 from 'vue-sweetalert2';
// import 'sweetalert2/dist/sweetalert2.min.css';
// Vue.use(VueSweetalert2); 
function userguard(to, from, next) {
    let authenticated = false;
    var user = localStorage.getItem('user');
    if (user) {
        authenticated = true;
    }
    else {
        authenticated = false;

    }
    if (authenticated) {
        next();
    }
    else {
        // this.$swal('Not Authenticated!','Please login first','info');
        // swal("Not Authenticated!! Login first!", {  
        //     buttons: ["oh no!", "oh yes!"],  
        //   }); 
        alert("Not Authenticated!! Login first!");
        next('/login');
    }
}
export default new Router({
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/contact',
            name: 'Contact',
            component: Contact
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/cart',
            name: 'Cart',
            component: Cart
        },
        {
            path: '/product/:id',
            name: 'ProductDetails',
            component: ProductDetails
        },
        {
            path: '/products',
            name: 'Product',
            component: Product
        },
        {
            path: '/subcategory/:id',
            name: 'SubCategoryProducts',
            component: SubCategoryProducts
        },
        {
            path: '/userinfo/:id',
            name: 'UserInfo',
            beforeEnter: userguard,
            component: UserInfo
        },
        {
            path: '/editprofile',
            name: 'EditProfile',
            beforeEnter: userguard,
            component: EditProfile
        },
        {
            path: '/changepassword',
            name: 'ChangePassword',
            beforeEnter: userguard,
            component: ChangePassword
        },
        {
            path: '/checkout',
            name: 'Checkout',
            beforeEnter: userguard,
            component: Checkout
        },
        {
            path: '/wishlist/:id',
            name: 'Wishlist',
            beforeEnter: userguard,
            component: Wishlist
        },
        {
            path: '/myorders/:id',
            name: 'MyOrders',
            beforeEnter: userguard,
            component: MyOrders
        },
        {
            path: '/shop',
            name: 'Shop',
            component: Shop
        },
    ],
    mode: 'history'
})