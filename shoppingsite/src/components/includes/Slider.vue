<template>
  <section id="slider">
    <!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li
                data-target="#slider-carousel"
                data-slide-to="0"
                class="active"
              ></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
              <div class="item active">
                <div class="col-sm-6">
                  <h1><span>E</span>-SHOPPER</h1>
                  <h2>{{ first.heading }}</h2>
                  <p>
                    {{ first.description }}
                  </p>
                  <button type="button" class="btn btn-default get">
                    Get it now
                  </button>
                </div>
                <div class="col-sm-6">
                  <img
                    :src="url + first.image"
                    class="img-responsive"
                    alt="Banner Image"
                    width="300px"
                  />
                </div>
              </div>

              <div v-for="bann in banner" :key="bann.index" class="item">
                <div class="col-sm-6">
                  <h1><span>E</span>-SHOPPER</h1>
                  <h2>{{ bann.heading }}</h2>
                  <p>
                    {{ bann.description }}
                  </p>
                  <button type="button" class="btn btn-default get">
                    Get it now
                  </button>
                </div>
                <div class="col-sm-6">
                  <img
                    :src="url + bann.image"
                    class="girl img-responsive"
                    alt="Banner Images"
                    width="250px"
                  />
                </div>
              </div>
            </div>

            <a
              href="#slider-carousel"
              class="left control-carousel hidden-xs"
              data-slide="prev"
            >
              <i class="fa fa-angle-left"></i>
            </a>
            <a
              href="#slider-carousel"
              class="right control-carousel hidden-xs"
              data-slide="next"
            >
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/slider-->
</template>

<script>
import axios from "axios";

export default {
  name: "Slider",
  data() {
    return {
      banner: null,
      first: null,
      url: "http://127.0.0.1:8000/BannerImages/",
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/banners").then(($res) => {
      console.log($res.data);
      this.first = $res.data.banners[0];
      this.banner = $res.data.banners.slice(1);
      console.log(this.first.heading);
    });
  },
};
</script>

<style>
</style>