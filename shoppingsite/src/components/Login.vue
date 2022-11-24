<template>
  <section id="form">
    <!--form-->
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
          <div class="login-form">
            <!--login form-->
            <h2>Login to your account</h2>
            <form @submit.prevent="postLogin">
              <input
                type="email"
                placeholder="Email Address"
                v-model="user.email"
              />
              <div
                v-if="submitted && $v.user.email.$error"
                class="invalid-feedback text-danger"
              >
                <span v-if="!$v.user.email.required">Email is required</span>
                <span v-else-if="!$v.user.email.email">Email is invalid</span>
              </div>

              <input
                type="password"
                placeholder="Password"
                v-model="user.password"
              />
              <div
                v-if="submitted && !$v.user.password.required"
                class="invalid-feedback text-danger"
              >
                Password is required
              </div>
              <span>
                <input type="checkbox" class="checkbox" />
                Keep me signed in
              </span>
              <button type="submit" class="btn btn-default">Login</button>
            </form>
          </div>
          <!--/login form-->
        </div>
        <div class="col-sm-1">
          <h2 class="or">OR</h2>
        </div>
        <div class="col-sm-4">
          <div class="signup-form">
            <!--sign up form-->
            <h2>New User Signup!</h2>
            <div v-if="load" class="spiner-border spiner-border-sm">
                  <h2 style="color:green"><i class="fa fa-spiner"></i>Please wait...</h2>
            </div>
            <form @submit.prevent="postRegister">
              <input
                type="text"
                placeholder="First Name"
                v-model="regis.firstname"
              />
              <div
                v-if="submit && $v.regis.firstname.$error"
                class="invalid-feedback text-danger"
              >
                <span v-if="!$v.regis.firstname.required"
                  >First name is required</span
                >
                <span v-else-if="!$v.regis.firstname.minLength"
                  >Minimun length should be 2</span
                >
              </div>
              <input
                type="text"
                placeholder="Last Name"
                v-model="regis.lastname"
              />
              <div
                v-if="submit && $v.regis.lastname.$error"
                class="invalid-feedback text-danger"
              >
                <span v-if="!$v.regis.lastname.required"
                  >Last name is required</span
                >
                <span v-else-if="!$v.regis.lastname.minLength"
                  >Minimun length should be 2</span
                >
              </div>
              <input
                type="email"
                placeholder="Email Address"
                v-model="regis.email"
              />
              <div
                v-if="submit && $v.regis.email.$error"
                class="invalid-feedback text-danger"
              >
                <span v-if="!$v.regis.email.required">Email is required</span>
                <span v-else-if="!$v.regis.email.email">Email is invalid</span>
              </div>
              <input
                type="password"
                placeholder="Password"
                v-model="regis.password"
              />
              <div
                v-if="submit && $v.regis.password.$error"
                class="invalid-feedback text-danger"
              >
                <span v-if="!$v.regis.password.required"
                  >Password is required</span
                >
                <span v-if="!$v.regis.password.minLength"
                  >Password must be at least 6 characters</span
                >
              </div>
              <input
                type="password"
                placeholder="Confirm Password"
                v-model="regis.confirmpassword"
              />
              <div
                v-if="submit && $v.regis.confirmpassword.$error"
                class="invalid-feedback text-danger"
              >
                <span v-if="!$v.regis.confirmpassword.required"
                  >Confirm Password is required</span
                >
                <span v-else-if="!$v.regis.confirmpassword.sameAsPassword"
                  >Password and confim pass must match</span
                >
              </div>
              <button type="submit" class="btn btn-default">Signup</button>
            </form>
          </div>
          <!--/sign up form-->
        </div>
      </div>
    </div>
  </section>
  <!--/form-->
</template>

<script>
import { userLogin } from "@/Common/Service";
import { userRegister } from "@/Common/Service";
import { saveToken } from "@/Common/JWTtoken";
import { email, required, minLength, sameAs } from "vuelidate/lib/validators";
export default {
  name: "Login",
  data() {
    return {
      user: {
        email: null,
        password: null,
      },
      submitted: false,
      regis: {
        firstname: null,
        lastname: null,
        email: null,
        password: null,
        confirmpassword: null,
      },
        loading:false,
      submit: false,
    };
  },
  validations: {
    user: {
      email: { required, email },
      password: { required },
    },
    regis: {
      firstname: { required, minLength: minLength(2) },
      lastname: { required, minLength: minLength(2) },
      email: { required, email },
      password: { required, minLength: minLength(6) },
      confirmpassword: { required, sameAsPassword: sameAs("password") },
    },
  },
  methods: {
    postLogin() {
      this.submitted = true;

      // stop here if form is invalid
      this.$v.user.$touch();
      if (this.$v.user.$invalid) {
        return;
      }
      // alert("Login Successfull");
      else {
        let formData = { email: this.user.email, password: this.user.password };
        userLogin(formData)
          .then((res) => {
            if (res.data.err == 0) {
              saveToken(res.data.token);
              console.log(res.data.user);
              let userinfo;
              userinfo = JSON.stringify(res.data.user);
              localStorage.setItem("user", userinfo);
              this.$store.dispatch("userInfo", userinfo);
              this.$router.push("/");
              this.$swal("Login Successfull!!", "", "success");
              window.location.reload();
            }
            if (res.data.err == 1) {
              console.log(res.data.err);
              // alert(res.data.msg);
              this.$swal(res.data.msg, "", "error");
            }
          })
          .catch((err) => {
            console.log("Something Wrong " + err);
          });
      }
    },
    postRegister() {
      this.submit = true;

      // stop here if form is invalid
      this.$v.regis.$touch();
      if (this.$v.regis.$invalid) {
        return;
      } else {
        this.load = true;
        let Data = {
          firstname: this.regis.firstname,
          lastname: this.regis.lastname,
          email: this.regis.email,
          password: this.regis.password,
          confirmpassword: this.regis.confirmpassword,
        };
        userRegister(Data)
          .then((res) => {
            if (res.data.error == 0) {
              this.$swal(res.data.msg, "", "success");
              window.location.reload("/");
            }
            if (res.data.error == 1) {
              this.load = false;
              this.$swal(res.data.msg, "", "error");
            }
          })
          .catch((err) => {
            console.log("Error while registering " + err);
          })
          .finally(() => (this.load = false));
      }
    },
  },
};
</script>

<style>
</style>