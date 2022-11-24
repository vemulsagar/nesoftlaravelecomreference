<template>
  <section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Check out</li>
        </ol>
      </div>
      <!--/breadcrums-->

      <div class="step-one">
        <h2 class="heading">Step1</h2>
      </div>

      <div class="shopper-informations">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-5 clearfix">
            <div class="bill-to">
              <p>Bill To</p>
              <div class="form-one">
                <form @submit.prevent="placeorder">
                  <input type="email" placeholder="Email*" v-model="email" />
                  <div
                    v-if="submit && $v.email.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.email.required">Email is required</span>
                    <span v-else-if="!$v.email.email">Invalid Email</span>
                  </div>
                  <input
                    type="text"
                    placeholder="First Name *"
                    v-model="firstname"
                  />
                  <div
                    v-if="submit && $v.firstname.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.firstname.required"
                      >firstname is required</span
                    >
                    <span v-else-if="!$v.firstname.minLength"
                      >Minlength should be 2</span
                    >
                  </div>
                  <input
                    type="text"
                    placeholder="Middle Name"
                    v-model="middlename"
                  />
                  <div
                    v-if="submit && $v.middlename.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.middlename.minLength"
                      >Minlength should be 2</span
                    >
                  </div>
                  <input
                    type="text"
                    placeholder="Last Name *"
                    v-model="lastname"
                  />
                  <div
                    v-if="submit && $v.lastname.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.lastname.required"
                      >lastname is required</span
                    >
                    <span v-else-if="!$v.lastname.minLength"
                      >Minlength should be 2</span
                    >
                  </div>
                  <input
                    type="text"
                    placeholder="Address 1 *"
                    v-model="address1"
                  />
                  <div
                    v-if="submit && $v.address1.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.address1.required"
                      >address1 is required</span
                    >
                    <span v-else-if="!$v.address1.minLength"
                      >Minlength should be 2</span
                    >
                  </div>
                  <input
                    type="text"
                    placeholder="Address 2"
                    v-model="address2"
                  />
                </form>
              </div>
              <div class="form-two">
                <form @submit.prevent="placeorder">
                  <input
                    type="text"
                    placeholder="Zip / Postal Code *"
                    v-model="pcode"
                  />
                  <div
                    v-if="submit && $v.pcode.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.pcode.required">pcode is required</span>
                    <span v-else-if="!$v.pcode.minLength"
                      >Length should be 6</span
                    >
                    <span v-else-if="!$v.pcode.maxLength"
                      >Length should be 6</span
                    >
                  </div>
                  <input
                    type="text"
                    placeholder="Mobile no *"
                    v-model="mobile"
                  />
                  <div
                    v-if="submit && $v.mobile.$error"
                    class="invalid-feedback text-danger"
                  >
                    <span v-if="!$v.mobile.required"
                      >mobile no is required</span
                    >
                    <span v-else-if="!$v.mobile.minLength"
                      >Only 10 digits allowed</span
                    >
                    <span v-else-if="!$v.mobile.maxLength"
                      >Only 10 digits allowed</span
                    >
                  </div>
                  <!-- <button type="submit" class="btn btn-primary">
                    Place Order
                  </button> -->
                </form>
              </div>
              <!-- <div class="col-sm-10">
                <div v-if="loading" class="spiner-border spiner-border-sm">
                  <h2 style="color:green"><i class="fa fa-spiner"></i>Processing...Please wait</h2>
                  <p style="color:red">Do not refresh!!</p>
                </div>
              </div> -->
            </div>
          </div>
          <div class="col-sm-4">
            <div class="order-message">
              <p>Shipping Order</p>
              <textarea
                name="message"
                placeholder="Notes about your order, Special Notes for Delivery"
                rows="16"
              ></textarea>
              <label><input type="checkbox" /> Shipping to bill address</label>
            </div>
          </div>
        </div>
      </div>
      <div class="review-payment">
        <h2>Review & Payment</h2>
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
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in cart" :key="item.id" :item="item">
              <td class="cart_product">
                <a href=""
                  ><img :src="url + item.image" alt="" height="200" width="150"
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
                  <input
                    class="cart_quantity_input"
                    type="text"
                    name="quantity"
                    v-model="item.quantity"
                    autocomplete="off"
                    size="2"
                    readonly
                  />
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">
                  {{ parseInt(item.quantity) * parseInt(item.price) }}
                </p>
              </td>
            </tr>
            <tr>
              <td colspan="4">&nbsp;</td>
              <td colspan="2">
                <table class="table table-condensed total-result">
                  <tr>
                    <td>Cart Sub Total</td>
                    <td>{{ total() }}</td>
                  </tr>
                  <tr v-if="couponApp()">
                    <td>Coupon Applied</td>
                    <td>-{{ couponApp() }}</td>
                  </tr>
                  <tr class="shipping-cost">
                    <td>Shipping Cost</td>
                    <td v-if="total() > 500.0">Free</td>
                    <td v-else>+ RS.50</td>
                  </tr>
                  <tr>
                    <td>Total</td>
                    <td>
                      <span>{{ cartvalue() }}</span>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="step-one">
        <h2 class="heading">Step2</h2>
      </div>
      <div class="payment-options">
        <span>
          <label><input type="checkbox" /> Cash on Delivery</label>
        </span>
        <span id="ccheck">
          <label
            ><input type="checkbox" v-model="check" @click="paymentPay()" />
            Paypal Payment</label
          >
          <div v-if="check == true">
            <Paypal />
          </div>
        </span>
        <div class="shopper-informations">
          <div class="row">
            <div class="col-sm-10">
              <div v-if="loading" class="spiner-border spiner-border-sm">
                <h2 style="color: green">
                  <i class="fa fa-spiner"></i>Processing...Please wait
                </h2>
                <p style="color: red">Do not refresh!!</p>
              </div>
            </div>
            <div class="col-sm-2">
              <form @submit.prevent="placeorder">
                <button class="btn btn-default check_out" type="submit">
                  Place Order
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/#cart_items-->
</template>

<script>
import { orderplaced } from "@/Common/Service";
import Paypal from "../components/Paypal.vue";
import {
  email,
  required,
  minLength,
  maxLength,
} from "vuelidate/lib/validators";
export default {
  name: "Checkout",
  components: {
    Paypal,
  },
  data() {
    return {
      el: "#ccheck",
      check: false,
      loading: false,
      cart: [],
      user: null,
      userid: null,
      email: null,
      firstname: null,
      middlename: null,
      lastname: null,
      address1: null,
      address2: null,
      pcode: null,
      mobile: null,
      submit: false,
      shipping: 50,
      couponid: null,
      cart_sub_total: null,
      finaltotal: null,
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
  validations: {
    email: { required, email },
    firstname: { required, minLength: minLength(2) },
    middlename: { minLength: minLength(2) },
    lastname: { required, minLength: minLength(2) },
    address1: { required, minLength: minLength(2) },
    address2: { minLength: minLength(2) },
    pcode: { required, minLength: minLength(6), maxLength: maxLength(6) },
    mobile: { required, minLength: minLength(10), maxLength: maxLength(10) },
  },
  props: ["item", "carttotal", "couponval"],
  methods: {
    placeorder() {
      this.submit = true;

      // stop here if form is invalid
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        this.loading = true;
        let total = this.cartvalue();
        let cart_sub_total = this.total();
        this.couponid = JSON.parse(localStorage.getItem("couponid"));
        let user = JSON.parse(localStorage.getItem("user"));
        let userid = user.id;
        let formData = {
          email: this.email,
          firstname: this.firstname,
          middlename: this.middlename,
          lastname: this.lastname,
          address1: this.address1,
          address2: this.address2,
          pcode: this.pcode,
          mobile: this.mobile,
          user: userid,
          cart: this.cart,
          total: total,
          cart_sub_total: cart_sub_total,
          shipping_cost: this.shipping,
          status:"PENDING",
          coupon_id: this.couponid,
        };
        console.log(formData);
        orderplaced(formData)
          .then((res) => {
            if (res.data.err == 0) {
              this.$swal(res.data.success, "", "success");
              localStorage.removeItem("myCart");
              localStorage.removeItem("coupon");
              localStorage.removeItem("couponid");
              this.$router.push("/");
            }
            if (res.data.err == 1) {
              console.log(res.data.msg);
              this.$swal(res.data.msg, "", "error");
            }
          })
          .catch((err) => {
            console.log("Something Wrong " + err);
          })
          .finally(() => (this.loading = false));
      }
    },
    total() {
      const item = JSON.parse(localStorage.getItem("myCart"));
      var sum = 0;
      item.forEach((ele) => {
        sum = sum + ele.price * ele.quantity;
      });
      return sum;
    },
    cartvalue() {
      if (this.total() > 500) {
        this.shipping = 0;
      }
      let couponapp = localStorage.getItem("coupon");
      var cartval = this.total() + this.shipping - couponapp;
      localStorage.setItem("cartvalue", cartval);
      return cartval;
    },
    couponApp() {
      return localStorage.getItem("coupon");
    },
  },
  mounted() {
    this.cart = JSON.parse(localStorage.getItem("myCart"));
    console.log(this.cart);
    this.userid = localStorage.getItem("user");
    this.user = this.user.id;
  },
};
</script>

<style>
</style>