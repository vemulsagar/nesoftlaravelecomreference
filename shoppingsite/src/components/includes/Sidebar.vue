<template>
  <div class="col-sm-3">
    <div class="left-sidebar">
      <h2>Category</h2>
      <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        <div
          class="panel panel-default"
          v-for="cat in categories"
          :key="cat.id"
        >
          <div class="panel-heading">
            <h4 class="panel-title">
              <router-link
                data-toggle="collapse"
                data-parent="#accordian"
                :to="'#' + cat.id"
              >
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                {{ cat.name }}
              </router-link>
            </h4>
          </div>
          <div :id="cat.id" class="panel-collapse collapse">
            <div class="panel-body">
              <div v-for="subcat in cat.subcategory" :key="subcat.index">
                <ul>
                  <li v-if="cat.id == subcat.category_id">
                    <router-link
                      :to="{
                        name: 'SubCategoryProducts',
                        params: { id: subcat.id },
                      }"
                      >{{ subcat.name }}
                    </router-link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                Mens
              </a>
            </h4>
          </div>
          <div id="mens" class="panel-collapse collapse">
            <div class="panel-body">
              <ul>
                <li><a href="#">Fendi</a></li>
                <li><a href="#">Guess</a></li>
                <li><a href="#">Valentino</a></li>
                <li><a href="#">Dior</a></li>
                <li><a href="#">Versace</a></li>
                <li><a href="#">Armani</a></li>
                <li><a href="#">Prada</a></li>
                <li><a href="#">Dolce and Gabbana</a></li>
                <li><a href="#">Chanel</a></li>
                <li><a href="#">Gucci</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                Womens
              </a>
            </h4>
          </div>
          <div id="womens" class="panel-collapse collapse">
            <div class="panel-body">
              <ul>
                <li><a href="#">Fendi</a></li>
                <li><a href="#">Guess</a></li>
                <li><a href="#">Valentino</a></li>
                <li><a href="#">Dior</a></li>
                <li><a href="#">Versace</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Kids</a></h4>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Fashion</a></h4>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Households</a></h4>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Interiors</a></h4>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Clothing</a></h4>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Bags</a></h4>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title"><a href="#">Shoes</a></h4>
          </div>
        </div> -->
      </div>
      <!--/category-products-->

      <div class="brands_products">
        <!--brands_products-->
        <!-- <h2>Brands</h2>
        <div class="brands-name">
          <ul class="nav nav-pills nav-stacked">
            <li>
              <a href="#"> <span class="pull-right">(50)</span>Acne</a>
            </li>
            <li>
              <a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a>
            </li>
            <li>
              <a href="#"> <span class="pull-right">(27)</span>Albiro</a>
            </li>
            <li>
              <a href="#"> <span class="pull-right">(32)</span>Ronhill</a>
            </li>
            <li>
              <a href="#"> <span class="pull-right">(5)</span>Oddmolly</a>
            </li>
            <li>
              <a href="#"> <span class="pull-right">(9)</span>Boudestijn</a>
            </li>
            <li>
              <a href="#">
                <span class="pull-right">(4)</span>Rösch creative culture</a
              >
            </li>
          </ul>
        </div> -->
      </div>
      <!--/brands_products-->

      <div class="price-range">
        <!--price-range-->
        <!-- <h2>Price Range</h2>
        <div class="well text-center">
          <input
            type="text"
            class="span2"
            value=""
            data-slider-min="0"
            data-slider-max="600"
            data-slider-step="5"
            data-slider-value="[250,450]"
            id="sl2"
          /><br />
          <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div> -->
      </div>
      <!--/price-range-->

      <div class="shipping text-center">
        <!--shipping-->
        <img src="images/home/shipping.jpg" alt="" />
      </div>
      <!--/shipping-->
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Sidebar",
  data() {
    return {
      categories: null,
      product: null,
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/categories").then(($res) => {
      console.log($res.data);
      this.categories = $res.data.categories;
    });
  },
};
</script>

<style>
</style>