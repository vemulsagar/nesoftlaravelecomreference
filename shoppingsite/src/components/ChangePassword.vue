<template>
  <div class="container">
    <div class="col-sm-2"></div>
    <div class="signup-form col-sm-8">
      <form class @submit.prevent="changepass">
        <input type="password" placeholder="Old Password" v-model="oldpass" />
        <div
          v-if="submit && $v.oldpass.$error"
          class="invalid-feedback text-danger"
        >
          <span v-if="!$v.oldpass.required">Old Password is required</span>
        </div>
        <input type="password" placeholder="New Password" v-model="newpass" />
        <div
          v-if="submit && $v.newpass.$error"
          class="invalid-feedback text-danger"
        >
          <span v-if="!$v.newpass.required">New Password is required</span>
          <span v-else-if="!$v.newpass.minLength"
            >Minimun length should be 6</span
          >
        </div>
        <input
          type="password"
          placeholder="Confirm Password"
          v-model="confirmpass"
        />
        <div
          v-if="submit && $v.confirmpass.$error"
          class="invalid-feedback text-danger"
        >
          <span v-if="!$v.confirmpass.required"
            >Confirm Password is required</span
          >
          <span v-if="!$v.confirmpass.sameAsPassword"
            >Confirm Password does not match</span
          >
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import { removeToken } from "@/Common/JWTtoken";
import { changePassword } from "@/Common/Service";
import { required, minLength, sameAs } from "vuelidate/lib/validators";
export default {
  name: "ChangePassword",
  data() {
    return {
      oldpass: null,
      newpass: null,
      confirmpass: null,
      submit: false,
    };
  },
  validations: {
    oldpass: { required },
    newpass: { required, minLength: minLength(6) },
    confirmpass: { required, sameAsPassword: sameAs("newpass") },
  },
  props: ["id"],
  methods: {
    changepass() {
      this.submit = true;

      // stop here if form is invalid
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        let user = JSON.parse(localStorage.getItem("user"));
        let userid = user.id;
        console.log(userid);
        let formData = {
          id: userid,
          oldpass: this.oldpass,
          newpass: this.newpass,
          confirmpass: this.confirmpass,
        };
        console.log(formData);
        changePassword(formData)
          .then((res) => {
            if (res.data.success) {
              this.logout();
              this.$swal(
                "Successfull! Login again!!",
                res.data.success,
                "success"
              );
            }
            if (res.data.err == 1) {
              console.log(res.data.msg);
              this.$swal(res.data.msg, "", "error");
            }
          })
          .catch((err) => {
            console.log("Something Wrong " + err);
            this.$swal("Something Wrong ");
          });
      }
    },
    logout() {
      localStorage.removeItem("myCart");
      localStorage.removeItem("user");
      localStorage.removeItem("coupon");
      localStorage.removeItem("couponid");
      removeToken();
      this.$router.push("/");
      return 0;
    },
  },
};
</script>

<style>
</style>