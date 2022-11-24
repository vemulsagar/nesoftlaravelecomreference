<template>
  <div id="contact-page" class="container">
    <div class="bg">
      <div class="row">
        <div class="col-sm-8">
          <div class="contact-form">
            <h2 class="title text-center">Get In Touch</h2>
            <div class="status alert alert-success" style="display: none"></div>
            <form
              id="main-contact-form"
              class="contact-form row"
              name="contact-form"
              @submit.prevent="postcontact"
            >
              <div class="form-group col-md-6">
                <input
                  type="text"
                  v-model="name"
                  class="form-control"
                  placeholder="Name"
                />
                <div
                  v-if="submitted && $v.name.$error"
                  class="invalid-feedback text-danger"
                >
                  <span v-if="!$v.name.required"> Name is required</span>
                  <span v-else-if="!$v.name.minLength"
                    >Minimun length should be 2</span
                  >
                </div>
              </div>
              <div class="form-group col-md-6">
                <input
                  type="email"
                  v-model="email"
                  class="form-control"
                  placeholder="Email"
                />
                <div
                  v-if="submitted && $v.email.$error"
                  class="invalid-feedback text-danger"
                >
                  <span v-if="!$v.email.required">Email is required</span>
                  <span v-else-if="!$v.email.email">Email is invalid</span>
                </div>
              </div>
              <div class="form-group col-md-12">
                <input
                  type="text"
                  v-model="subject"
                  class="form-control"
                  placeholder="Subject"
                />
                <div
                  v-if="submitted && $v.subject.$error"
                  class="invalid-feedback text-danger"
                >
                  <span v-if="!$v.subject.required">Subject is required</span>
                  <span v-else-if="!$v.subject.minLength"
                    >Minimun length should be 3</span
                  >
                </div>
              </div>
              <div class="form-group col-md-12">
                <textarea
                  v-model="message"
                  id="message"
                  class="form-control"
                  rows="8"
                  placeholder="Your Message Here"
                ></textarea>
                <div
                  v-if="submitted && $v.message.$error"
                  class="invalid-feedback text-danger"
                >
                  <span v-if="!$v.message.required">Subject is required</span>
                  <span v-else-if="!$v.message.minLength"
                    >Minimun length should be 3</span
                  >
                </div>
              </div>
              <div class="form-group col-md-12">
                <input
                  type="submit"
                  name="submit"
                  class="btn btn-primary pull-right"
                  value="Submit"
                />
              </div>
            </form>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="contact-info">
            <h2 class="title text-center">Contact Info</h2>
            <address v-if="address">
              <p>{{ address.name }}</p>
              <p>{{ address.address1 }}</p>
              <p>{{ address.address2 }}</p>
              <p>{{ address.state }} &nbsp; {{ address.country }}</p>
              <p>Mobile: +{{ address.mobile }}</p>
              <p>Fax: {{ address.fax }}</p>
              <p>Email: {{ address.email }}</p>
            </address>
            <div class="social-networks">
              <h2 class="title text-center">Social Networking</h2>
              <ul>
                <li>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-youtube"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/#contact-page-->
</template>

<script>
import { userContactus } from "@/Common/Service";
import { email, required, minLength } from "vuelidate/lib/validators";
import axios from "axios";
export default {
  name: "Contact",
  data() {
    return {
      name: null,
      email: null,
      subject: null,
      message: null,
      submitted: false,
      address: [],
    };
  },
  validations: {
    name: { required, minLength: minLength(2) },
    email: { required, email },
    subject: { required, minLength: minLength(3) },
    message: { required, minLength: minLength(3) },
  },
  methods: {
    postcontact() {
      this.submitted = true;

      // stop here if form is invalid
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      } else {
        let formData = {
          name: this.name,
          email: this.email,
          subject: this.subject,
          message: this.message,
        };
        console.log(formData);
        userContactus(formData)
          .then((res) => {
            if (res.data.error == 0) {
              alert("Form submitted successfully");
              window.location.reload("/");
            }
            if (res.data.error == 1) {
              console.log(res.data.err);
              alert(res.data.msg);
            }
          })
          .catch((err) => {
            console.log("Something Wrong " + err);
          });
      }
    },
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/cmsaddress").then(($res) => {
      console.log($res.data);
      this.address = $res.data.add;
      console.log(this.address);
    });
  },
};
</script>

<style>
</style>