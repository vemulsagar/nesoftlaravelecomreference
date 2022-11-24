<template>
  <div class="container justify-content-center">
    <div class="col-sm-2"></div>
    <div class="signup-form col-sm-8">
      <form @submit.prevent="update">
        <input
          type="text"
          placeholder="First Name"
          v-model="userinfo.first_name"
        />
        <div
          v-if="submit && $v.userinfo.first_name.$error"
          class="invalid-feedback text-danger"
        >
          <span v-if="!$v.userinfo.first_name.required"
            >First name is required</span
          >
          <span v-else-if="!$v.userinfo.first_name.minLength"
            >Minimun length should be 2</span
          >
        </div>
        <input
          type="text"
          placeholder="Last Name"
          v-model="userinfo.last_name"
        />
        <div
          v-if="submit && $v.userinfo.last_name.$error"
          class="invalid-feedback text-danger"
        >
          <span v-if="!$v.userinfo.last_name.required"
            >Last name is required</span
          >
          <span v-else-if="!$v.userinfo.last_name.minLength"
            >Minimun length should be 2</span
          >
        </div>
        <input
          type="email"
          placeholder="Email Address"
          v-model="userinfo.email"
        />
        <div
          v-if="submit && $v.userinfo.email.$error"
          class="invalid-feedback text-danger"
        >
          <span v-if="!$v.userinfo.email.required">Email is required</span>
          <span v-else-if="!$v.userinfo.email.email">Email is invalid</span>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</template>

<script>
import { profile } from "@/Common/Service";
import { editProfile } from "@/Common/Service";
import { email, required, minLength } from "vuelidate/lib/validators";
export default {
  name: "EditProfile",
  data() {
    return {
      userinfo: {
        first_name: "",
        last_name: "",
        email: "",
      },
      submit: false,
    };
  },
  validations: {
    userinfo: {
      first_name: { required, minLength: minLength(2) },
      last_name: { required, minLength: minLength(2) },
      email: { required, email },
    },
  },
  methods: {
    update() {
      this.submit = true;
      // stop here if form is invalid
      this.$v.userinfo.$touch();
      if (this.$v.userinfo.$invalid) {
        return;
      } else {
        let user = JSON.parse(localStorage.getItem("user"));
        let userid = user.id;
        let Data = {
          userid: userid,
          firstname: this.userinfo.first_name,
          lastname: this.userinfo.last_name,
          email: this.userinfo.email,
        };
        editProfile(Data)
          .then((res) => {
            if (res.data.err == 0) {
              this.$swal(res.data.success, "", "success");
              window.location.reload("/");
            }
            if (res.data.err == 1) {
              alert("Error");
            }
          })
          .catch((err) => {
            console.log("Error while registering " + err);
          });
      }
    },
  },
  watch: {
    $route(to) {
      this.param = to.params.id;
      profile(this.param).then((res) => {
        this.userinfo = res.data.user;
        console.log(res.data);
      });
    },
  },
  created() {
    this.param = this.$route.params.id;
  },
  mounted() {
    profile(this.param)
      .then(($res) => {
        console.log($res.data);
        this.userinfo = $res.data.user;
      })
      .catch((error) => {
        console.log("Something went wrong" + error);
      });
  },
};
</script>

<style>
</style>