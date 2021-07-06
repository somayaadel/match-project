<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-col w-3/4">
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
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h3 class="text-title-grey title-patient py-5">New Country</h3>
      <h1 class="my-3 text-title-grey">Add New Country</h1>
    </div>

    <div class="vx-row mt-5">
      <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
      <div
        class="vx-col w-full md:w-full sm:w-full lg:w-full xl:w-full flex flex-col lg:mb-0 md:mb-base sm:mb-0 mb-base mt-4"
      >
        <vx-card title="    ">
          <div class="vx-row mb-2">
            <div class="vx-col w-full">
              <vs-input
                class="w-full"
                type="text"
                icon-pack="feather"
                icon="icon-user"
                icon-no-border
                label-placeholder=" Name"
                name="name"
                v-validate="'required'"
                v-model="countryData.name"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('name')"
                >{{ errors.first("name") }}</span
              >
            </div>
          </div>

          <div class="vx-row mb-2">
            <div class="vx-col w-full">
              <vs-input
                class="w-full"
                type="text"
                icon-pack="feather"
                icon="icon-user"
                icon-no-border
                label-placeholder=" Name"
                name="name_ar"
                v-validate="'required'"
                v-model="countryData.name_ar"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('name_ar')"
                >{{ errors.first("name_ar") }}</span
              >
            </div>
          </div>

          

        
          <div class="vx-row">
            <div class="vx-col w-full">
              <vs-button class="mr-3 mb-2" color="primary" @click="submitData()"
                >Submit</vs-button
              >
            </div>
          </div>
        </vx-card>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "../../../axios.js";
// import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";

export default {
  name: "imageUpload",
  data() {
    return {
      products: [],
      companies: [],
      previewImage: null,

      programs: [],
      users: [],
      searchQuery: "",
      countryData  :{
          name : '' , 
      }
    };
  },
  mounted() {
    // this.getCompanies();
    // this.getUsers();
    // this.getPrograms();
  },
  created() {
    // axios
    //   .get("/api/product")
    //   .then((res) => {
    //     this.products = res.data.data;
    //   })
    //   .catch((err) => {
    //     console.log(err);
    //   });
  },

    methods: {
  //     uploadImage(e) {
  //       const image = e.target.files[0];
  //       const reader = new FileReader();
  //       reader.readAsDataURL(image);
  //       reader.onload = (e) => {
  //         this.previewImage = e.target.result;
  //         console.log(this.previewImage);
  //       };
  //     },
      submitData() {
          axios
            .post("/api/country", this.countryData)
            .then((res) => {
                this.$router.push({ name: "countryList" });
                // this.$router.go();
            })
            .catch((err) => {
                console.log(err);
          });
      },
      
    },
};
</script>


