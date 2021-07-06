<template>
  <div class="container">
    <div class="vx-row">
      
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h3 class="text-title-grey title-patient py-5">New city</h3>
      <h1 class="my-3 text-title-grey">Add New city</h1>
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
                label-placeholder="Name"
                name="name"
                v-validate="'required'"
                v-model="cityData.name"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('name')"
                >{{ errors.first("name") }}</span
              >
            </div>

            <div class="vx-col w-full">
              <vs-input
                class="w-full"
                type="text"
                icon-pack="feather"
                icon="icon-user"
                icon-no-border
                label-placeholder="Name in Arabic"
                name="name_ar"
                v-validate="'required'"
                v-model="cityData.name_ar"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('name_ar')"
                >{{ errors.first("name_ar") }}</span
              >
            </div>


            <div class="vx-col w-full py-5">
              <vs-select
                autocomplete
                class="selectExample w-full"
                label="country"
                name="service_id"
                v-validate="'required'"
                v-model="cityData.country_id"
                label-placeholder=" country"
              >
                <vs-select-item
                  :key="index"
                  :value="item.id"
                  :text="item.name"
                  v-for="(item, index) in countries"
                />
              </vs-select>
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
      countries :[] , 
      programs: [],
      cityData  :{
          name : '' , 
          country_id : ''
      }
    };
  },
  mounted() {
    this.createAPi() ; 
  },
  created() {

  },

    methods: {
      createAPi() {
        axios
          .get("/api/city/create")
          .then((res) => {
            this.countries = res.data.countries;
          })
          .catch((err) => {
          });
      },
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
            .post("/api/city", this.cityData)
            .then((res) => {
                console.log(res.data);
                this.$router.push({ name: "cityList" });
                // this.$router.go();
            })
            .catch((err) => {
                console.log(err);
          });
      },
      
    },
};
</script>


