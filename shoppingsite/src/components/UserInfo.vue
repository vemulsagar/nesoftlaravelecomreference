<template>
  <section id="cart_items">
    <div class="container">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <td
                class="cart_menu"
                style="
                   {
                    width: 50px;
                  }
                "
              >
                First Name
              </td>
              <td>{{ userinfo.first_name }}</td>
            </tr>
            <tr>
              <td class="cart_menu">Last Name</td>
              <td>{{ userinfo.last_name }}</td>
            </tr>
            <tr>
              <td class="cart_menu">Email</td>
              <td>{{ userinfo.email }}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="cart_product">
                <router-link
                  to="/editprofile"
                  class="btn btn-default add-to-cart"
                  >Edit Profile
                </router-link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
// import axios from 'axios';
import { profile } from "@/Common/Service";
export default {
  name: "UserInfo",
  data() {
    return {
      param: null,
      userinfo: [],
    };
  },

  watch: {
    $route(to) {
      this.param = to.params.id;
      profile(this.param).then((res) => {
        this.userinfo = res.data.user;
        console.log(res.data);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
  },
  mounted() {
    profile(this.param)
      .then(($res) => {
        console.log($res.data);
        this.userinfo = $res.data.user;
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>