<template>
  <div>
    <section class="cart_items">
      <div class="container">
        <div class="table-responsive cart_info">
          <table class="table table-condensed">
            <thead>
              <tr class="cart_menu">
                <td class="image">Item</td>
                <td class="description">Name & description</td>
                <td class="price">Price</td>
                <td></td>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in products" :key="item.id" :item="item">
                <td class="cart_product">
                  <a href=""
                    ><img
                      :src="url + item.product_image"
                      alt=""
                      height="200"
                      width="150"
                  /></a>
                </td>
                <td class="cart_description">
                  <h4>
                    <a href="">{{ item.product_name }}</a>
                  </h4>
                  <p>{{ item.product_description }}</p>
                </td>
                <td class="cart_price">
                  <p>{{ item.product_price }}</p>
                </td>
                <td class="cart_delete">
                  <button
                    @click="deleteItem(item.id)"
                    class="cart_quantity_delete"
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
  </div>
</template>

<script>
import { wishlistproduct } from "@/Common/Service";
import { DeleteItem } from "@/Common/Service";
export default {
  name: "Wishlist",
  data() {
    return {
      products: [],
      param: undefined,
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
  watch: {
    $route(to) {
      this.param = to.params.id;
      wishlistproduct(this.param).then((res) => {
        this.product = res.data.product;
        this.quantity = res.data.product.quantity;
        console.log(res.data);
        console.log(this.image2.image);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
  },
  methods: {
    deleteItem(id) {
      let user = localStorage.getItem("user");
      let userid = user.id;
      let data = { pid: id, user: userid };
      console.log(data);
      DeleteItem(data)
        .then((res) => {
          if (res.data.err == 0) {
            this.$swal("Deleted Successfull!!", "", "success");
            this.$router.push("/");
          }
          if (res.data.err == 1) {
            console.log(res.data.msg);
            alert(res.data.msg);
          }
        })
        .catch((err) => {
          console.log("Something Wrong " + err);
        });
    },
  },
  mounted() {
    wishlistproduct(this.param)
      .then(($res) => {
        console.log($res.data);
        this.products = $res.data.products;
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>