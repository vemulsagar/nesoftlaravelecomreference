<template>
  <header id="header">
    <!--header-->
    <div class="header_top">
      <!--header_top-->
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="contactinfo">
              <ul class="nav nav-pills">
                <li>
                  <a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-envelope"></i> info@domain.com</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="social-icons pull-right">
              <ul class="nav navbar-nav">
                <li>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-linkedin"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-dribbble"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/header_top-->

    <div class="header-middle">
      <!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
              <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
            </div>
            <div class="btn-group pull-right">
              <div class="btn-group">
                <button
                  type="button"
                  class="btn btn-default dropdown-toggle usa"
                  data-toggle="dropdown"
                >
                  USA
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Canada</a></li>
                  <li><a href="#">UK</a></li>
                </ul>
              </div>

              <div class="btn-group">
                <button
                  type="button"
                  class="btn btn-default dropdown-toggle usa"
                  data-toggle="dropdown"
                >
                  DOLLAR
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Canadian Dollar</a></li>
                  <li><a href="#">Pound</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li v-if="user">
                  <a class="dropdown-toggle usa" data-toggle="dropdown">
                    Account
                    <i class="fa fa-angle-down"></i>
                  </a>

                  <ul class="dropdown-menu">
                    <li>
                      <router-link
                        :to="{ name: 'UserInfo', params: { id: userid } }"
                        >Profile Info</router-link
                      >
                    </li>
                    <li>
                      <router-link to="/changepassword"
                        >Change Password</router-link
                      >
                    </li>
                  </ul>
                </li>
                <li>
                  <a v-if="user" href="#"
                    ><i class="fa fa-user">{{ user.email }}</i></a
                  >
                </li>
                <li>
                  <router-link
                    v-if="user"
                    :to="{ name: 'Wishlist', params: { id: userid } }"
                    ><i class="fa fa-star"></i> Wishlist</router-link
                  >
                </li>
                <li>
                  <router-link
                    v-if="user"
                    :to="{ name: 'MyOrders', params: { id: userid } }"
                    ><i class="fa fa-crosshairs"></i> MyOrders</router-link
                  >
                </li>
                <li>
                  <router-link to="/cart"
                    ><i class="fa fa-shopping-cart"></i> Cart<span
                      class="badge badge-pill badge-danger"
                      >{{ numInCart() }}</span
                    ></router-link
                  >
                </li>
                <li>
                  <router-link v-if="!user" to="/login"
                    ><i class="fa fa-lock"></i> Login</router-link
                  >
                  <a v-else v-on:click="logout()" href=""
                    ><i class="fa fa-lock"></i> Logout</a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/header-middle-->

    <div class="header-bottom">
      <!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button
                type="button"
                class="navbar-toggle"
                data-toggle="collapse"
                data-target=".navbar-collapse"
              >
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li>
                  <router-link to="/" class="active">Home</router-link>
                </li>
                <li class="dropdown">
                  <a href="#">Shop<i class="fa fa-angle-down"></i></a>
                  <ul role="menu" class="sub-menu">
                    <li><router-link to="/shop">Products</router-link></li>
                  </ul>
                </li>
                <li>
                  <router-link to="/contact">Contact</router-link>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="search_box pull-right">
              <input type="text" placeholder="Search" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/header-bottom-->
  </header>
  <!--/header-->
</template>

<script>
import { removeToken } from "@/Common/JWTtoken";
export default {
  name: "Header",

  methods: {
    numInCart() {
      return this.inCart.length;
    },
    numUser() {
      return this.user.length;
    },
    logout() {
      localStorage.removeItem("myCart");
      localStorage.removeItem("user");
      localStorage.removeItem("coupon");
      localStorage.removeItem("couponid");
      removeToken();
      this.$router.push("/");
      return 0;
    },
  },
  computed: {
    inCart() {
      return this.$store.getters.inCart;
    },
    user() {
      return JSON.parse(localStorage.getItem("user"));
    },
    userid() {
      let user = JSON.parse(localStorage.getItem("user"));
      let userid = user.id;
      return userid;
    },
  },
};
</script>

<style>
</style>