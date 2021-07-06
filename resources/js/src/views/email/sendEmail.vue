<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-col w-3/4"></div>
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h1 class="my-3 text-title-grey">Sending Email</h1>
    </div>

    <div class="vx-row mt-5">
      <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
      <div
        class="vx-col w-full md:w-full sm:w-full lg:w-full xl:w-full flex flex-col lg:mb-0 md:mb-base sm:mb-0 mb-base mt-4"
      >
        <vx-card title="    ">
          <div class="vx-row mb-2">
            <div class="vx-col w-1/4">
              <label class="float-right"><b>Send Message by</b></label>
            </div>
            <div class="vx-col w-1/2">
              <vs-input
                class="w-full float-left"
                type="text"
                icon-pack="feather"
                icon="icon-user"
                icon-no-border
              />
            </div>
          </div>
          <div class="vx-row mb-2">
            <div class="vx-col w-1/4">
              <label class="float-right"><b>Select Emails</b></label>
            </div>
            <div class="vx-col w-1/2">
              <vs-select
                autocomplete
                class="selectExample w-full"
                name="featureName"
                label-placeholder=" memberss"
              >
                <vs-select-item />
              </vs-select>
            </div>
          </div>
          <div class="vx-row mb-2">
            <div class="vx-col w-1/4">
              <label class="float-right"><b>Message</b></label>
            </div>
            <div class="vx-col w-1/2">
              <vs-textarea
                class="w-full float-left"
                type="text"
                row="10"
                placeholder="Message"
              />
            </div>
          </div>

          <div class="vx-row py-5">
            <div class="vx-col w-full">
              <vs-button
                class="mr-3 mb-2 float-right"
                color="primary"
                @click="submitData()"
                >Send</vs-button
              >
            </div>
          </div>
        </vx-card>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../../axios.js";

export default {
  name: "imageUpload",
  data() {
    return {
      subProducts: [],
      products: [],
      companies: [],
      previewImage: null,

      programs: [],

      users: [],
      searchQuery: "",
      productData: {
        name: "",
        logo: "",
        company_id: "",
        program_id: "",
        user_id: "",
        description: "",
      },
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
    addSubcategory() {
      this.subProducts.push({ name: "" });
    },
    removeSubcategory(index) {
      this.subProducts.splice(index, 1);
    },
  },
};
</script>
