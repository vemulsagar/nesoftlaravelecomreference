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
            <div
              class="col-sm-4"
              v-for="product in subcatproducts"
              :key="product.id"
            >
              <div class="product-image-wrapper">
                <div class="single-products">
                  <div class="productinfo text-center">
                    <img
                      :src="url + product.images[0].image"
                      alt="Product Images"
                      :width="100"
                      :height="250"
                    />
                    <h2>RS.{{ product.price }}</h2>
                    <p>{{ product.name }}</p>
                    <p>{{ product.description }}</p>
                    <button
                      class="btn btn-default add-to-cart"
                      @click="
                        addToCart(
                          product.id,
                          product.name,
                          product.images[0].image,
                          product.price,
                          product.description
                        )
                      "
                    >
                      <i class="fa fa-shopping-cart"></i>Add to cart
                    </button>
                  </div>
                  <div class="product-overlay">
                    <div class="overlay-content">
                      <h2>{{ product.name }}</h2>
                      <p>RS.{{ product.price }}</p>
                      <button
                        class="btn btn-default add-to-cart"
                        @click="
                          addToCart(
                            product.id,
                            product.name,
                            product.images[0].image,
                            product.price,
                            product.description
                          )
                        "
                      >
                        <i class="fa fa-shopping-cart"></i>Add to cart
                      </button>
                    </div>
                  </div>
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li>
                      <a href="#"
                        ><i class="fa fa-heart-o" style="font-size: 15px"></i
                        >Add to wishlist</a
                      >
                    </li>
                    <li>
                      <a href="#"
                        ><i class="fa fa-plus-square"></i>Add to compare</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--features_items-->
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { SubCategoryProducts } from "@/Common/Service";
import Sidebar from "../components/includes/Sidebar.vue";
import Slider from "../components/includes/Slider.vue";
export default {
  name: "SubCategoryProducts",
  data() {
    return {
      subcatproducts: [],
      param: undefined,
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
  watch: {
    $route(to) {
      this.param = to.params.id;
      SubCategoryProducts(this.param).then((res) => {
        this.subcatproducts = res.data.products;
        console.log(res.data);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
  },
  mounted() {
    SubCategoryProducts(this.param)
      .then(($res) => {
        console.log($res.data);
        this.subcatproducts = $res.data.products;
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
  props: ["id", "pname", "image", "price", "quantity", "description"],
  methods: {
    addToCart(id, pname, image, price, quantity, description) {
      if (localStorage.getItem("myCart") != undefined) {
        let arr = JSON.parse(localStorage.getItem("myCart"));
        let obj = {
          pid: id,
          quantity: 1,
          pname: pname,
          image: image,
          price: price,
          pquantity: quantity,
          description: description,
        };
        arr.push(obj);
        localStorage.setItem("myCart", JSON.stringify(arr));
        this.$store.dispatch("addToCart", arr);
        this.$swal("Product Added!!", pname, "success");
      } else {
        let arr = [];
        let obj = {
          pid: id,
          quantity: 1,
          pname: pname,
          image: image,
          price: price,
          pquantity: quantity,
          description: description,
        };
        arr.push(obj);
        console.log(obj);
        localStorage.setItem("myCart", JSON.stringify(arr));
        this.$store.dispatch("addToCart", arr);
        this.$swal("Product Added", "Xyz", "success");
      }
    },
  },
  components: {
    Slider,
    Sidebar,
  },
};
</script>

<style>
</style>