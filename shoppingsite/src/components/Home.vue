<template>
  <section>
    <Slider />
    <div class="container">
      <div class="row">
        <Sidebar />
        <div class="col-sm-9 padding-right">
          <div class="features_items">
            <!--features_items-->
            <h2 class="title text-center">Features Items</h2>
            <Product
              v-for="product in products"
              :key="product.id"
              :id="product.id"
              :pname="product.name"
              :image="product.images[0].image"
              :price="product.price"
              :quantity="product.quantity"
              :description="product.description"
            />
          </div>
          <!--features_items-->
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import Slider from "./includes/Slider.vue";
import Sidebar from "./includes/Sidebar.vue";
import Product from "./Product.vue";
import axios from "axios";
export default {
  name: "Home",
  data() {
    return {
      products: [],
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },

  components: {
    Slider,
    Sidebar,
    Product,
  },

  mounted() {
    axios.get("http://127.0.0.1:8000/api/products").then(($res) => {
      console.log($res.data);
      this.products = $res.data.products;
      console.log(this.products);
    });
  },
};
</script>

<style>
</style>