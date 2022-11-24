<template>
  <div class="col-sm-4">
    <div class="product-image-wrapper">
      <div class="single-products">
        <div class="productinfo text-center">
          <img
            :src="url + image"
            alt="Product Images"
            :width="100"
            :height="250"
          />
          <h2>RS.{{ price }}</h2>
          <p>{{ pname }}</p>
          <button
            class="btn btn-default add-to-cart"
            @click="addToCart(id, pname, image, price, description)"
          >
            <i class="fa fa-shopping-cart"></i>Add to cart
          </button>
        </div>
        <div class="product-overlay">
          <div class="overlay-content">
            <h2>{{ pname }}</h2>
            <p>RS.{{ price }}</p>
            <button
              class="btn btn-default add-to-cart"
              @click="addToCart(id, pname, image, price, quantity, description)"
            >
              <i class="fa fa-shopping-cart"></i>Add to cart
            </button>
          </div>
        </div>
      </div>
      <div class="choose">
        <ul class="nav nav-pills nav-justified">
          <li>
            <button
              @click="addtowishlist(id, pname, image, price, description)"
              class="btn btn-default"
            >
              <i class="fa fa-heart-o" style="font-size: 15px"></i>Add to
              wishlist
            </button>
          </li>
          <li>
            <router-link :to="{ name: 'ProductDetails', params: { id: id } }"
              ><i class="fa fa-plus-square"></i>View</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { AddToWishlist } from "@/Common/Service";
export default {
  name: "Product",
  data() {
    return {
      url: "http://127.0.0.1:8000/ProductImages/",
    };
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
        window.location.reload("/");
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
    addtowishlist(id, pname, image, price, description) {
      let user = JSON.parse(localStorage.getItem("user"));
      let userid = user.id;
      let data = {
        pid: id,
        user: userid,
        pname: pname,
        image: image,
        price: price,
        description: description,
      };
      console.log(data);
      AddToWishlist(data)
        .then((res) => {
          if (res.data.err == 0) {
            this.$swal("Added Successfull!!", "", "success");
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
};
</script>

<style>
</style>