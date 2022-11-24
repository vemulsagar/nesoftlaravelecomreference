<template>
  <section>
    <div class="container">
      <div class="row">
        <Sidebar />

        <div class="col-sm-9 padding-right">
          <div class="product-details">
            <!--product-details-->
            <div class="col-sm-5">
              <div class="view-product">
                <img
                  :src="url + product.images[0].image"
                  alt="Product Image"
                  width="200px"
                  height="200px"
                />
                <!-- <h3>ZOOM</h3> -->
              </div>
              <div
                id="similar-product"
                class="carousel slide"
                data-ride="carousel"
              >
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <a v-for="image in image2" :key="image.id" href=""
                      ><img
                        :src="url + image.image"
                        alt="Product Image"
                        width="100px"
                    /></a>
                  </div>
                </div>

                <!-- Controls -->
                <a
                  class="left item-control"
                  href="#similar-product"
                  data-slide="prev"
                >
                  <i class="fa fa-angle-left"></i>
                </a>
                <a
                  class="right item-control"
                  href="#similar-product"
                  data-slide="next"
                >
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-sm-7">
              <div class="product-information">
                <!--/product-information-->
                <img
                  src="images/product-details/new.jpg"
                  class="newarrival"
                  alt=""
                />
                <h2>{{ product.name }}</h2>
                <p>{{ product.id }}</p>
                <span>
                  <span>Rs {{ product.price }}</span>
                  <label>Quantity: </label>
                  <select
                    name="quantity"
                    class="dropdown"
                    id=""
                    style="width: 40px"
                  >
                    <option v-for="i in pquantity" :key="i.id">{{ i }}</option>
                  </select>
                  <button
                    type="button"
                    class="btn btn-fefault cart"
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
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                  </button>
                </span>
                <p><b>Availability:</b> In Stock</p>
                <p><b>Brand:</b> E-SHOPPER</p>
                <a href=""
                  ><img
                    src="images/product-details/share.png"
                    class="share img-responsive"
                    alt=""
                /></a>
              </div>
              <!--/product-information-->
            </div>
          </div>
          <!--/product-details-->

          <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
              <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                <li>
                  <a href="#companyprofile" data-toggle="tab"
                    >Company Profile</a
                  >
                </li>
                <li><a href="#tag" data-toggle="tab">Tag</a></li>
                <li class="active">
                  <a href="#reviews" data-toggle="tab">Reviews (5)</a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade" id="details">
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery1.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery3.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery4.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="companyprofile">
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery1.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery3.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery4.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="tag">
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery1.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery3.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="product-image-wrapper">
                    <div class="single-products">
                      <div class="productinfo text-center">
                        <img src="images/home/gallery4.jpg" alt="" />
                        <h2>$56</h2>
                        <p>Easy Polo Black Edition</p>
                        <button
                          type="button"
                          class="btn btn-default add-to-cart"
                        >
                          <i class="fa fa-shopping-cart"></i>Add to cart
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade active in" id="reviews">
                <div class="col-sm-12">
                  <ul>
                    <li>
                      <a href=""><i class="fa fa-user"></i>EUGEN</a>
                    </li>
                    <li>
                      <a href=""><i class="fa fa-clock-o"></i>12:41 PM</a>
                    </li>
                    <li>
                      <a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a>
                    </li>
                  </ul>
                  <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua.Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis
                    aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur.
                  </p>
                  <p><b>Write Your Review</b></p>

                  <form action="#">
                    <span>
                      <input type="text" placeholder="Your Name" />
                      <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b>
                    <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                      Submit
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/category-tab-->

          <div class="recommended_items">
            <!--recommended_items-->
            <h2 class="title text-center">recommended items</h2>
          </div>
          <!--/recommended_items-->
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { product } from "@/Common/Service";
import Sidebar from "./includes/Sidebar.vue";
export default {
  name: "ProductDetails",
  components: {
    Sidebar,
  },
  data() {
    return {
      product: [],
      param: undefined,
      pquantity: null,
      image2: null,
      url: "http://127.0.0.1:8000/ProductImages/",
    };
  },
  watch: {
    $route(to) {
      this.param = to.params.id;
      product(this.param).then((res) => {
        this.product = res.data.product;
        this.quantity = res.data.product.quantity;
        this.image2 = res.data.product.images.slice(1);
        console.log(res.data);
        console.log(this.image2.image);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
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
        window.location.reload("/");
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
  mounted() {
    product(this.param)
      .then(($res) => {
        console.log($res.data);
        this.product = $res.data.product;
        this.pquantity = $res.data.product.quantity;
        this.image2 = $res.data.product.images.slice(1);
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>