
<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-row mt-5 w-full">
        <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
        <div class="vx-col w-full md:w-full sm:w-full">
          <vx-card>
            <div class="row px-3">
              <h1 class="my-3 text-title-grey">Add New Categories</h1>
            </div>

            <div class="vx-row mb-2">
              <div class="vx-col w-full">
                <vs-input
                  class="w-full my-5 px-5"
                  type="text"
                  icon-pack="feather"
                  icon-no-border
                  label-placeholder=" category Name"
                  name="categoryName"
                  v-validate="'required'"
                  v-model="categoryData.name"
                />
                <vs-input
                  class="w-full my-5 px-5"
                  type="text"
                  icon-pack="feather"
                  icon-no-border
                  label-placeholder=" category Name in arabic"
                  name="categoryNameinarabic"
                  v-validate="'required'"
                  v-model="categoryData.name_ar"
                />
                <vs-input
                  class="w-full my-5 px-5"
                  type="text"
                  icon-pack="feather"
                  icon-no-border
                  label-placeholder=" type"
                  name="type"
                  v-validate="'required'"
                  v-model="categoryData.category_type.name"
                />

                <div class="vx-row mb-6 upload">
                  <div class="vx-col md:w-100 w-full mt-5">
                    <vs-upload
                      limit="1"
                      text="edit Application Logo"
                      id="ufile"
                      ref="ufile"
                      fileName="CODE"
                      action
                    />
                  </div>
                </div>

                <div class="logo">
                  <img
                    :src="
                      categoryData.image
                        ? categoryData.image
                        : 'https://idraksy.net/wp-content/uploads/2020/04/placeholder.png'
                    "
                    alt="content-img"
                    class="responsive card-img-top company-imgg p-3"
                    style="width: 200px; height: 200px"
                  />
                </div>
              </div>
              <div class="vx-col w-full mt-5 px-5">
                <vs-button
                  :ref="'refCategory'"
                  :color="categoryId != '' ? 'rgb(0,200,0)' : 'rgb(200,0,0)'"
                  class="float-right px-5"
                  @click="savePhoto()"
                  >Update</vs-button
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
import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";
import applicationSelect from "../helper/applicationSelect";

export default {
  components: {
    applicationSelect,
  },
  data() {
    return {
      applications: [],
      subCategories: [],
      previewImage: null,
      categoryId: "",
      categoryData: {
        name: "",
        name_ar: "",
        type: "",
        image: "",
        application_id: "",
      },
      subcategoryLogo: [],
    };
  },
  mounted() {
    this.getCategoryData();
  },
  created() {},

  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    getCategoryData() {
      axios
        .get("/api/category/" + this.$route.params.id)
        .then((res) => {
          this.categoryData = res.data.data;
          console.log("dddd", this.categoryData.category_type.name);
          this.categoryId = res.data.data.id;
          this.subCategories = res.data.data.sub_categories;
        })
        .catch((err) => {});
    },
    savePhoto() {
      this.categoryData.image = this.$refs.ufile.filesx[0];
      if (!this.$refs.ufile.filesx[0]) {
        this.updateCategory();
        return;
      }
      var component = this;
      var reader = new FileReader();
      reader.readAsDataURL(this.categoryData.image);
      reader.onload = function () {
        component.categoryData.image = reader.result;
        component.updateCategory();
      };
    },
    updateCategory() {
      this.categoryData.application_id = this.application_id;
      console.log("ggg", this.categoryData);
      axios
        .put("/api/category/" + this.$route.params.id, this.categoryData)
        .then((res) => {
          this.categoryData = res.data.data;
        })
        .catch((err) => {});
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: "User Deleted",
        text: msg,
      });
    },
    showError(msg) {
      this.$vs.notify({
        color: "danger",
        title: "Error",
        text: msg,
        position: "top-center",
      });
    },
    fileUploaded() {
      let ref = `file`;
    },
  },
};
</script>

<style scoped>
.upload {
  position: absolute;
  z-index: 300;
  top: 250px;
  width: 240px;
  height: 150px;
  opacity: 0;
  left: 10px;
}
.logo {
  position: relative;
  margin-top: 70px;
}
.up {
  margin-top: 50;
}
</style>

