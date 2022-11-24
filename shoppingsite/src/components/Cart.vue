<template>
  <div>
    <section id="cart_items">
      <div class="container">
        <div class="breadcrumbs">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Shopping Cart</li>
          </ol>
        </div>
        <div class="table-responsive cart_info">
          <table class="table table-condensed">
            <thead>
              <tr class="cart_menu">
                <td class="image">Item</td>
                <td class="description"></td>
                <td class="price">Price</td>
                <td class="quantity">Quantity</td>
                <td class="total">Total</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in cart" :key="item.id" :item="item">
                <td class="cart_product">
                  <a href=""
                    ><img
                      :src="url + item.image"
                      alt=""
                      height="200"
                      width="150"
                  /></a>
                </td>
                <td class="cart_description">
                  <h4>
                    <a href="">{{ item.pname }}</a>
                  </h4>
                  <p>{{ item.description }}</p>
                </td>
                <td class="cart_price">
                  <p>{{ item.price }}</p>
                </td>
                <td class="cart_quantity">
                  <div class="cart_quantity_button">
                    <a class="cart_quantity_up" @click="addItem(item)"> + </a>
                    <input
                      class="cart_quantity_input"
                      type="text"
                      name="quantity"
                      v-model="item.quantity"
                      autocomplete="off"
                      size="2"
                    />
                    <a class="cart_quantity_down" @click="subItem(item)"> - </a>
                  </div>
                </td>
                <td class="cart_total">
                  <p class="cart_total_price">
                    {{ parseInt(item.quantity) * parseInt(item.price) }}
                  </p>
                </td>
                <td class="cart_delete">
                  <button
                    class="cart_quantity_delete"
                    @click="DeleteItem(item)"
                  >
                    <i class="fa fa-times"></i>
                  </button>
                </td>
                <td class="cart_total"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <!--/#cart_items-->
    <section id="do_action">
      <div class="container">
        <div class="heading">
          <h3>What would you like to do next?</h3>
          <p>
            Choose if you have a discount code or reward points you want to use
            or would like to estimate your delivery cost.
          </p>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="chose_area">
              <ul class="user_option">
                <li>
                  <ul>
                    <div class="chose_area">
                      <label class="text-success"
                        ><b>Coupons available-</b>
                      </label>
                      <li v-for="coupon in totalcoupons" :key="coupon.index">
                        <b
                          ><label>"{{ coupon.code }}"</label></b
                        >&nbsp;&nbsp;
                        <span class="text-danger"
                          >* Only valid for purchase above
                          {{ coupon.cart_value }}</span
                        >
                      </li>
                    </div>
                  </ul>
                </li>
                <li id="ccheck">
                  <input type="checkbox" id="coupon" v-model="checked" />
                  <label>Use Coupon Code</label><br />
                  <form v-if="checked" @submit.prevent="postcoupon">
                    <div
                      v-if="submit && !$v.coupon.couponcode.required"
                      class="invalid-feedback text-danger"
                    >
                      Coupon Code is required
                    </div>
                    <input type="text" v-model="coupon.couponcode" /><br />
                    <button type="submit" class="btn btn-default check_out">
                      Apply
                    </button>
                  </form>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="total_area">
              <ul>
                <li>
                  Cart Sub Total
                  <span :carttotal="total">RS.{{ total() }}</span>
                </li>
                <li v-if="total() > 500.0">Shipping Cost <span>Free</span></li>
                <li v-else>Shipping Cost <span>+RS.50</span></li>
                <li v-if="couponApp()">
                  Coupon Applied<span>-{{ couponApp() }}</span>
                </li>
                <li>
                  Total <span>RS.{{ cartvalue() }}</span>
                </li>
              </ul>
              <router-link class="btn btn-default check_out" :class="{ disabled: total() ==0}" to="/checkout"
                >Check Out</router-link
              >
              <router-link class="btn btn-default check_out" to="/"
                >Add More</router-link
              >
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--/#do_action-->
</template>

<script>
import { coupons } from "@/Common/Service";
import { applycoupon } from "@/Common/Service";
import { required } from "vuelidate/lib/validators";
export default {
  name: "Cart",
  data() {
    return {
      el: "#ccheck",
      checked: false,
      coupon: {
        couponcode: null,
      },
      submit: false,
      cart: undefined,
      couponValue: null,
      couponApplied: null,
      totalcoupons: [],
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
  validations: {
    coupon: {
      couponcode: { required },
    },
  },
  props: ["item", "carttotal", "couponval"],
  methods: {
    addItem(cart) {
      cart.quantity = cart.quantity + 1;
      localStorage.setItem("myCart", JSON.stringify(this.cart));
    },
    subItem(cart) {
      cart.quantity = cart.quantity - 1;
      localStorage.setItem("myCart", JSON.stringify(this.cart));
    },
    DeleteItem(item) {
      var del = this.cart.indexOf(item);
      this.cart.splice(del, 1);
      localStorage.setItem("myCart", JSON.stringify(this.cart));
    },
    total() {
      const item = JSON.parse(localStorage.getItem("myCart"));
      var sum = 0;
      item.forEach((ele) => {
        sum = sum + ele.price * ele.quantity;
      });
      return sum;
    },
    postcoupon() {
      this.submit = true;

      // stop here if form is invalid
      this.$v.coupon.$touch();
      if (this.$v.coupon.$invalid) {
        return;
      } else {
        let subtotal = this.cartvalue();
        let formData = { code: this.coupon.couponcode, carttotal: subtotal };
        console.log(formData);
        applycoupon(formData)
          .then((res) => {
            if (res.data.err == 0) {
              this.couponValue = res.data.cvalue;
              localStorage.setItem("coupon", this.couponValue);
              localStorage.setItem("couponid", res.data.couponid);
              this.$store.dispatch("couponApplied", this.couponValue);
              this.couponApplied = localStorage.getItem("coupon");
              this.$swal(res.data.success, "", "success");
              window.location.reload("/");
            }
            if (res.data.err == 1) {
              this.$swal(res.data.err, "", "error");
              console.log(res.data.msg);
            }
          })
          .catch((err) => {
            console.log("Something Wrong " + err);
          });
      }
    },
    cartvalue() {
      var shipping = 50;
      if (this.total() > 500) {
        shipping = 0;
      }
      let couponapp = localStorage.getItem("coupon");
      var cartval = this.total() + shipping - couponapp;
      return cartval;
    },
    couponApp() {
      return localStorage.getItem("coupon");
    },
  },
  mounted() {
    this.cart = JSON.parse(localStorage.getItem("myCart"));
    console.log(this.cart);
    coupons()
      .then(($res) => {
        console.log($res.data.coupons);
        this.totalcoupons = $res.data.coupons;
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>