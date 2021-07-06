<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <div
    class="h-screen flex w-full bg-img vx-row no-gutter items-center justify-center"
    id="page-login"
  >
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-3/4 xl:w-3/5 sm:m-0 m-4">
      <vx-card>
        <div slot="no-body" class="full-page-bg-color">
          <div class="vx-row no-gutter justify-center items-center">
            <div class="vx-col sm:w-full md:w-full lg:block lg:w-1/2">
              <div class="px-8 pt-8 login-tabs-container">
                <div class="vx-card__title mb-4">
                  <!-- <h4 class="mb-4"></h4> -->
                  <img src="@assets/images/logo/logo.png" alt="graphic-404" />
                  <br />
                  <br />
                  <h2>Welcome back</h2>
                  <br />

                  <p>
                    It is a long established fact that a reader will be
                    distracted by the readable content of a page when looking at
                    its layout.
                  </p>
                </div>

                <div class="vx-row mb-2">
                  <div class="vx-col w-full">
                    <vs-input
                      v-validate="'required|email|min:3'"
                      data-vv-validate-on="blur"
                      name="email"
                      icon-no-border
                      icon="icon icon-user"
                      icon-pack="feather"
                      v-model="email"
                      type="email"
                      class="w-full"
                      label-placeholder="Email"
                    />
                    <span class="text-danger text-sm">{{
                      errors.first("email")
                    }}</span>
                  </div>
                </div>
                <div class="vx-row mb-6">
                  <div class="vx-col w-full">
                    <vs-input
                      data-vv-validate-on="blur"
                      v-validate="'required|min:6|max:10'"
                      type="password"
                      name="password"
                      icon-no-border
                      icon="icon icon-lock"
                      icon-pack="feather"
                      label-placeholder="Password"
                      v-model="password"
                      class="w-full mt-6"
                    />
                    <span class="text-danger text-sm">{{
                      errors.first("password")
                    }}</span>
                  </div>
                </div>

                <div class="flex flex-wrap justify-between my-5">
                  <vs-checkbox v-model="checkbox_remember_me" class="mb-3"
                    >Remember Me</vs-checkbox
                  >
                  <router-link to="/pages/forgot-password"
                    >Forgot Password?</router-link
                  >
                </div>

                <vs-button
                  class="w-full"
                  color="danger"
                  size="large"
                  :disabled="!validateForm"
                  @click="loginJWT"
                  >LOGIN
                </vs-button>

                <!-- <vs-tabs>
                                    <vs-tab label="JWT">
                                      <login-jwt></login-jwt>
                                    </vs-tab>
                                    <vs-tab label="Firebase">
                                      <login-firebase></login-firebase>
                                    </vs-tab>
                                    <vs-tab label="Auth0">
                                      <login-auth0></login-auth0>
                                    </vs-tab>
                                  </vs-tabs>  -->
              </div>
            </div>

            <div class="vx-col lg:block hidden lg:w-1/2 d-theme-dark-bg"></div>
          </div>
        </div>
      </vx-card>
    </div>
  </div>
</template>


<script>
import axios from "../../../axios";
export default {
  data() {
    return {
      email: "",
      password: "",
      checkbox_remember_me: false,
      user: [],
    };
  },
  computed: {
    validateForm() {
      return !this.errors.any() && this.email != "" && this.password != "";
    },
  },
  created() {
    // console.log('jer') ;
    this.checkLogin();
  },
  methods: {
    checkLogin() {},
    loginJWT() {
      // console.log(axios);
      axios
        .post("/api/auth/login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          localStorage.setItem("accessToken", res.data.access_token);
          localStorage.setItem("userInfo", JSON.stringify(res.data.user));


          axios.defaults.headers.Authorization = "Bearer " + localStorage.getItem("accessToken") ; 
          this.$root.$children[0]._data.key++;

          this.$router.push({ name: "dashboard" });

        })
        .catch((err) => {
          console.log("error : ", err);
        });
    },
  },
};
</script>


<style lang="scss">
.login-tabs-container {
  min-height: 505px;
  .con-tab {
    padding-bottom: 14px;
  }
  .con-slot-tabs {
    margin-top: 1rem;
  }
}
</style>
