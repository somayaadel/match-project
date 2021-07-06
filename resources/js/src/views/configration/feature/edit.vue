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
            <h3 class="text-title-grey title-patient py-5">New feature</h3>
            <h1 class="my-3 text-title-grey">Add New feature</h1>
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
                                v-validate="'required'"
                                v-model="feature_data.name"
                            />
                        </div>

                        <div class="vx-col w-full py-5">
                            <vs-select
                                autocomplete
                                class="selectExample w-full"
                                label="Type"
                                name="service_id"
                                v-validate="'required'"
                                v-model="feature_data.service_id"
                                label-placeholder=" type"
                            >
                                <vs-select-item
                                    :key="index"
                                    :value="item.id"
                                    :text="item.name"
                                    v-for="(item, index) in service"
                                />
                            </vs-select>
                        </div>
                    </div>

                    <div class="vx-row py-5">
                        <div class="vx-col w-full">
                            <vs-button
                                class="mr-3 mb-2"
                                color="danger"
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
import axios from "../../../axios.js";
// import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";

export default {
    name: "imageUpload",
    data() {
        return {
            service: [],
            searchQuery: "",
            feature_data: {
                name: "",
                service_id: ""
            }
        };
    },
    mounted() {},
    created() {
        this.getService();
        this.getFeatureData();
    },

    methods: {
        addSubcategory() {
            this.subProducts.push({ name: "" });
        },
        removeSubcategory(index) {
            this.subProducts.splice(index, 1);
        },
        getService() {
            axios
                .get("/api/feature/create")
                .then(res => {
                    this.service = res.data.data;
                })
                .catch(err => {
                });
        },
        getFeatureData() {
            axios.get("/api/feature/" + this.$route.params.id).then(res => {
                this.feature_data = res.data.data;
                this.feature_data.AllFeature = this.feature_data.features;
                for (var i = 0; i < this.feature_data.AllFeature.length; i++) {
                    his.feature_data.AllFeature[i].pivot.feature_id = "";
                }
                this.featuresKey++;

            });
        },
        submitData() {
            this.$validator.validateAll().then(res => {
                axios
                    .put(
                        "/api/feature/" + this.$route.params.id,
                        this.feature_data
                    )
                    .then(res => {
                        this.$router.push({ name: "featureList" });
                        this.showSuccess("Feature is created successfuly");
                    })
                    .catch(err => {
                        this.showError(err);
                    });
            });
        },
        showSuccess(msg) {
            this.$vs.notify({
                color: "success",
                title: "Coupon status",
                text: msg,
                position: "top-right"
            });
        },
        showError(msg) {
            this.$vs.notify({
                color: "danger",
                title: "Error",
                text: msg,
                position: "top-center"
            });
        }
        //     uploadImage(e) {
        //       const image = e.target.files[0];
        //       const reader = new FileReader();
        //       reader.readAsDataURL(image);
        //       reader.onload = (e) => {
        //         this.previewImage = e.target.result;
        //         console.log(this.previewImage);
        //       };
        //     },
        //     submitData() {
        //       axios
        //         .post("/api/product", this.productData)
        //         .then((res) => {
        //           this.$router.go();
        //         })
        //         .catch((err) => {
        //           console.log(err);
        //         });
        //     },

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
    }
};
</script>
