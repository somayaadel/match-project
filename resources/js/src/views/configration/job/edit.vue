<template>
  <div class="container">
    <div class="vx-row">
      
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h1 class="my-3 text-title-grey">Edit job</h1>
    </div>

    <div class="vx-row mt-5">
      <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
      <div
        class="vx-col w-full md:w-full sm:w-full lg:w-full xl:w-full flex flex-col lg:mb-0 md:mb-base sm:mb-0 mb-base mt-4"
      >
        <vx-card title="    ">
          <div class="vx-row mb-10">
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
                v-model="jobData.name"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('name')"
                >{{ errors.first("name") }}</span
              >
            </div>
          </div>

          <div class="vx-row mb-10">
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
                v-model="jobData.name_ar"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('name_ar')"
                >{{ errors.first("name_ar") }}</span
              >
            </div>
          </div>

 


          <div class="vx-row "  >
            <div class="vx-col w-full">
              <vs-button class="mt-10 mr-3 mb-2" color="primary" @click="submitData()"
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
      countries : [] , 
      programs: [],
      users: [],
      searchQuery: "",
      jobData  :{
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
    this.createAPi() ; 
    this.getjobData();
  },

    methods: {
      createAPi() {
        axios
          .get("/api/job/create")
          .then((res) => {
            this.countries = res.data.countries;
          })
          .catch((err) => {
              console.log(err);
          });
      },

      getjobData(){
        axios.get('/api/job/'+this.$route.params.id).then(res=>{
            this.jobData = res.data.data ; 
        })
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
            .put("/api/job/"+ this.$route.params.id , this.jobData)
            .then((res) => {
                console.log(res.data);
                this.$router.push({ name: "jobList" });
                // this.$router.go();
            })
            .catch((err) => {
                console.log(err);
            });
      },
      

  //     getCompanies() {
  //       axios
  //         .get("/api/company")
  //         .then((res) => {
  //           this.companies = res.data.data;
  //         })
  //         .catch((err) => {
  //           console.log(err);
  //         });
  //     },
  //     getPrograms() {
  //       axios
  //         .get("/api/program")
  //         .then((res) => {
  //           console.log(res.data.data[0]);
  //           this.programs = res.data.data;
  //         })
  //         .catch((err) => {
  //           console.log(err);
  //         });
  //     },

  //     getUsers() {
  //       axios
  //         .get("/api/user")
  //         .then((res) => {
  //           this.users = res.data.data;
  //         })
  //         .catch((err) => {
  //           console.log(err);
  //         });
  //     },
  //     successUpload(event) {
  //       console.log("success");
  //       this.$vs.notify({
  //         color: "success",
  //         title: "Upload Success",
  //         text: "Lorem ipsum dolor sit amet, consectetur",
  //       });
  //     },
  //     resetData() {
  //       Object.keys(this.productData).forEach((key) => {
  //         this.productData[key] = "";
  //       });
  //     },
  //     editProduct(id) {
  //       this.$router.push({ name: "editProduct", params: { id } });
  //     },
  //     deleteProduct(id) {
  //       axios
  //         .delete("/api/product/" + id)
  //         .then((res) => {
  //           this.$router.go();
  //         })
  //         .catch((err) => {
  //           console.log(err);
  //         });
  //     },
  //     fun(event) {
  //       console.log(event);
  //     },
    },
};
</script>

<style scoped>

</style>

