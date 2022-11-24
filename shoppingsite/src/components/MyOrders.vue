<template>
  <section id="cart_items">
    <div class="container">
      <router-link class="btn btn-default check_out mb-4" to="/"
        >Check Out Products</router-link
      >
      <div class="table-responsive cart_info">
        <table class="table table-condensed p-3">
          <thead>
            <tr class="cart_menu">
              <td class="image">Sr.no</td>
              <td class="name">Product</td>
              <td class="total">Cart Sub Total</td>
              <td class="total">Coupon Applied</td>
              <td class="total">Total</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="orderd in order" :key="orderd.id">
              <td>{{orderd.id - 1}}</td>
              <td>
                <table>
                  <thead>
                    <tr>
                      <td></td>
                    </tr>
                  </thead>
                  <tbody v-for="prod in products" :key="prod.ind">
                    <tr v-for="userord in orderd.userorder" :key="userord.in">
                      <td v-if="prod.id == userord.product_id">
                        {{prod.name}}
                    <img
                        :src="url + prod.images[0].image"
                        alt=""
                        width="100px"
                        height="100px"
                        class="mb-2"
                      />&nbsp;
                      <b>Price-</b>{{prod.price}}
                      &nbsp;
                      <b>Quantity-</b>{{userord.product_quantity}}
                      </td>
                    </tr>

                  </tbody>
                </table>
              </td>
             <td>{{orderd.orderdetail.cart_sub_total}}</td>
             <td v-if="orderd.orderdetail.coupon_id">Yes</td>
             <td v-else>No</td>
             <td>{{orderd.orderdetail.total}}</td>
           </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</template>

<script>
import { MyOrders } from "@/Common/Service";
export default {
  name: "MyOrders",
  data() {
    return {
      useraddress: [],
      products: [],
      order:[],
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
//   methods: {
//     formatMyOrderData(userOrders, products) {
    
//     if (userOrders && products) {
// userOrders.forEach(order => {
//       order['product'] = products.filter(product => order.product_id === product.id)[0];
//     });
//     this.myOrderData = userOrders;
//     }
//     console.log(this.myOrderData)
//     // return this.myOrderData;
// }

//   },
  watch: {
    $route(to) {
      this.param = to.params.id;
      MyOrders(this.param).then((res) => {
        this.useraddress = res.data.useraddress;
        this.products = res.data.products;
        console.log(res.data.useraddress);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
  },
  mounted() {
    MyOrders(this.param)
      .then(($res) => {
        this.order = $res.data.order;
        // this.userorders = $res.data.useraddress.userorder;
        console.log(this.order);
        // console.log(this.userorders);
       this.products = $res.data.products;
       console.log($res.data.products);
        // this.formatMyOrderData(this.userorders,this.products);
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>