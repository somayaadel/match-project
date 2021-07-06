<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-col w-full">
        <div class="search-page__search-bar flex items-center w-1/4">
          <vs-input
            icon-no-border
            placeholder="Search"
            v-model="searchQuery"
            class="w-full input-rounded-full"
            icon="icon-search"
            icon-pack="feather"
          />
        </div>
      </div>

      <div class="vx-row mt-5 w-full">
        <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
        <div class="vx-col w-full md:w-full sm:w-full">
          <vx-card>
            <div class="row px-3">
              <h3 class="text-title-grey title-patient py-5">New staff</h3>

              <h1 class="my-3 text-title-grey">Add New staff</h1>
            </div>

            <div class="vx-row mb-2">
              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5"
                  type="text"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  v-model="staffData.name"
                  label-placeholder=" Name"
                />
              </div>
              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5"
                  type="text"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  v-model="staffData.name_ar"
                  label-placeholder=" Name in arabic"
                />
              </div>
              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5"
                  type="email"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  v-model="staffData.email"
                  label-placeholder=" Email"
                />
              </div>

              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5"
                  type="password"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  label-placeholder=" Password"
                  v-model="staffData.password"
                />
              </div>
              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5"
                  type="password"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  label-placeholder=" Password Confirmation"
                  v-model="staffData.password_confirmation"
                />
              </div>
              <div class="vx-col w-full">
                <div class="vx-col sm:w-1/3 w-full">
                  <span>birth date</span>
                </div>
                <div class="vx-col w-full">
                  <datepicker
                    class="date-picker vx-col w-full"
                    type="date"
                    icon-pack="feather"
                    icon="icon-user"
                    icon-no-border
                    label-placeholder=" birth_date"
                    v-model="staffData.birth_date"
                  ></datepicker>
                </div>
              </div>
              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5"
                  type="number"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  label-placeholder="Phone"
                  v-model="staffData.phone"
                />
              </div>
              

              <div class="vx-col w-full">
                <div class="vx-row">
                  <vs-select
                    class="selectExample w-1/2 p-5"
                    label="Gender"
                    v-validate="'required'"
                    v-model="staffData.gender"
                  >
                    <vs-select-item value="1" text="male" />
                    <vs-select-item value="0" text="female" />
                  </vs-select>
                </div>
              </div>
            </div>

            <div class="vx-row">
              <div class="vx-col w-full mt-5">
                <vs-button
                  class="mr-3 mb-2"
                  color="primary"
                  @click="submitData()"
                  >Submit</vs-button
                >
              </div>
            </div>
          </vx-card>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "../../axios.js";
import Datepicker from "vuejs-datepicker";

export default {
  components: {
    Datepicker,
  },
  data() {
    return {
      applications: [],

      searchQuery: "",
      staffData: {
        name: "",
        name_ar: "",
        phone: "",
        email: "",
        gender: "",
        password: "",
        role_id: "4",
        password_confirmation: "",
        birth_date: "",
      },
      components: {
        Datepicker,
      },
    };
  },
  mounted() {
    this.getApplications();
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },

  methods: {
    submitData() {
      console.log("appid", this.application_id);
      this.staffData.application_id = this.application_id;
      axios
        .post("/api/user", this.staffData)
        .then((res) => {
          this.showSuccess("user has been created successfuly");
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getApplications() {
      axios
        .get("/api/application")
        .then((res) => {
          this.applications = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>


