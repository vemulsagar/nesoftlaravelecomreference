<template>
  <div>
    <div ref="paypal"></div>
  </div>
</template>

<script>

export default {
  name: "Paypal",

  data: function () {
    return {
      loaded: false,
      paidFor: false,
      product: {
        price: localStorage.getItem('cartvalue'),
        description: "Payment for your purchase",
      },
    };
  },
  mounted: function () {
    const script = document.createElement("script");
    script.src =
      "https://www.paypal.com/sdk/js?client-id=AcZpYM-lbYYwpmM8XN2qtsIlzZM5-y-kHpPOQov4uUwBByAJQxrgRs8vjon857LyEfPsE6DSVsxF4m9M";
    script.addEventListener("load", this.setLoaded);
    document.body.appendChild(script);
  },
  methods: {
    setLoaded: function () {
      this.loaded = true;
      window.paypal
        .Buttons({
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [
                {
                  description: this.product.description,
                  amount: {
                    currency_code: "USD",
                    value: this.product.price,
                  },
                },
              ],
            });
          },
          onApprove: async (data, actions) => {
            const order = await actions.order.capture();

            this.data;

            this.paidFor = true;
            this.$swal('Order placed successfully','','success');
             localStorage.removeItem("myCart");
              localStorage.removeItem("coupon");
              localStorage.removeItem("couponid");
              this.$router.push("/");
            console.log(order);
          },
          onError: (err) => {
            console.log(err);
          },
        })
        .render(this.$refs.paypal);
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>

