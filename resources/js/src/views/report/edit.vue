<template>
  <div class="container">
    <div class="vx-row">
     
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h1 class="my-3 text-title-grey">Edit Report</h1>
    </div>

    <div class="vx-row mt-5">
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
                label-placeholder=" Reason"
                name="reason"
                v-validate="'required'"
                v-model="reason"
              />
              <span
                class="text-danger text-sm"
                v-show="errors.has('reason')"
                >{{ errors.first("reason") }}</span
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
import axios from "../../axios.js";
// import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";
import editPhoto from "../helper/editPhoto.vue" ; 
export default {
  
  components:{
    editPhoto , 
  } , 
  data() {
    return {
      products: [],
      companies: [],
      previewImage: null,
reason:"",
      programs: [],
      applicationLogo : "" , 
      users: [],
      applicationData  :{
          name : '' , 
          logo:'' ,
      }
    };
  },
  mounted() {
    // this.getCompanies();
    // this.getUsers();
    // this.getPrograms();
  },
  created() {
    this.getApplicationData();
  },

    methods: {
      getApplicationData(){
        console.log('ref : ' , this.$refs.upload);
        axios.get('/api/report/'+this.$route.params.id).then(res=>{
            this.reason = res.data.data.reason ; 
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
            .put("/api/report/"+ this.$route.params.id ,{reason: this.reason})
            .then((res) => {
                this.$router.push({ name: "reportList" });
                // this.$router.go();
            })
            .catch((err) => {
            });
      },
     
    },
};
</script>

<style scoped>
.upload{
  position: absolute;
  z-index: 300;
  top: 90px;
  width: 250px;
  height: 200px;
  opacity: 0;
  left: 10px;
}
.logo{
  position: relative; 

}
</style>

