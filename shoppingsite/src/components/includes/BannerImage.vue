<template>
  <section id="advertisement">
    <div class="container">
      <img :src="url + banner.image" alt="" />
    </div>
  </section>
</template>

<script>
import axios from "axios";
export default {
  name: "BannerImage",
  data() {
    return {
      banner: null,
      url: "http://127.0.0.1:8000/CMSImage/",
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/bannerimage").then(($res) => {
      console.log($res.data);
      this.banner = $res.data.banners;
      console.log(this.banner);
    });
  },
};
</script>

<style>
</style>