<template>
    <div class="container">
        <div class="vx-row">
            <div class="vx-col w-1/4">
                <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
            </div>
        </div>
        <div class="row px-3 w-1/2">
            <h3 class="text-title-grey title-patient py-5">New Report</h3>
            <h1 class="my-3 text-title-grey">Add New Report</h1>
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
                                label-placeholder=" Reason"
                                name="reason"
                                v-validate="'required'"
                                v-model="reason"
                            />
                            <span
                                class="text-danger text-sm"
                                v-show="errors.has('name')"
                                >{{ errors.first("name") }}</span
                            >
                        </div>
                    </div>
                    <div class="vx-row">
                        <div class="vx-col w-full">
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
</template>

<script>
import axios from "../../axios.js";
// import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";

export default {
    name: "imageUpload",
    data() {
        return {
            products: [],
            companies: [],
            previewImage: null,
            reason:"",
            programs: [],
            applicationLogo: "",
            users: [],
            searchQuery: "",
            applicationData: {
                name: ""
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
                .post("/api/report", 
                {reason : this.reason})
                .then(res => {
                    console.log(res.data);
                    this.$router.push({ name: "reportList" });
                })
                .catch(err => {
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
        //         })
        //         .catch((err) => {
        //           console.log(err);
        //         });
        //     },
        //     fun(event) {
        //       console.log(event);
        //     },
    }
};
</script>
