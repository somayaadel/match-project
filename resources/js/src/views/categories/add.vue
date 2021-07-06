<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-row mt-5 w-full">
        <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
        <div class="vx-col w-full md:w-full sm:w-full">
          <vx-card>
            <div class="row px-3">
              <h1 class="my-3 text-title-grey">Add New Categories</h1>
              <div class>
                <vs-button
                  icon-pack="feather"
                  name="doctoradd"
                  icon="icon-edit"
                  class="mr-4 float-right mb-5"
                  color="primary"
                  :to="{ name: 'importCateg' }"
                  >+ import extra sheet</vs-button
                >
              </div>
            </div>

            <vx-card
              title="Add New Category"
              class="vx-col w-full sm:w-full sm:w-full lg:w-full xl:w-full flex flex-col overflow-hidden my-5"
            >
              <template class="overflow-hidden">
                <vs-button
                  :key="subCategoriesKey"
                  class="mb-2 float-right"
                  type="gradient"
                  icon="icon-plus"
                  icon-pack="feather"
                  radius
                  color="primary"
                  @click="addSubcategory()"
                ></vs-button>

                <div class="vx-row w-full mb-2">
                  <div
                    class="vx-col w-full"
                    v-for="(item, index) in categoryData"
                    :key="index"
                  >
                    <div class="vx-row w-full mb-2">
                      <vs-input
                        class="vx-col w-1/4"
                        type="text"
                        icon-no-border
                        label-placeholder=" Category name"
                        name=" Categoryname"
                        v-model="item.name"
                        :disabled="item.done"
                        v-validate="'required'"
                      />
                      <vs-input
                        class="vx-col w-1/4"
                        type="text"
                        icon-no-border
                        label-placeholder=" Category name in arabic"
                        name=" Categoryname"
                        v-model="item.name_ar"
                        :disabled="item.done"
                        v-validate="'required'"
                      />
                      <vs-select
                        class="vx-col w-1/3 selectExample"
                        label="Type"
                        name="role"
                        :disabled="item.done"
                        v-validate="'required'"
                        v-model="item.category_type_id"
                        label-placeholder=" type"
                      >
                        <vs-select-item
                          :key="index"
                          :value="item.id"
                          :text="item.name"
                          icon-no-border
                          label-placeholder=" type"
                          name=" type"
                          v-validate="'required'"
                          v-for="(item, index) in categoryTypes"
                        />
                      </vs-select>

                      <input
                        type="file"
                        :ref="'file' + index"
                        @change="fileUploaded(index)"
                        style="display: none"
                      />

                      <vs-button
                        class="vx-col w-2/4 float-right mt-4 mr-4"
                        color="success"
                        type="gradient"
                        radius
                        :disabled="item.done"
                        icon="photo_camera"
                        @click="buttonClicked(index)"
                      ></vs-button>

                      <vs-button
                        class="vx-col w-2/4 float-right mt-4 mr-4"
                        icon="done"
                        :ref="'ref' + index"
                        radius
                        :disabled="item.done"
                        :color="item.done ? 'rgb(0,200,0)' : 'rgb(200,0,0)'"
                        @click="submitSubCategory(categoryData, index)"
                      ></vs-button>

                      <vs-button
                        class="vx-col w-2/4 float-right mt-4 mr-4"
                        type="gradient"
                        icon="icon-trash"
                        icon-pack="feather"
                        radius
                        color="danger"
                        @click="removeSubcategory(index)"
                      ></vs-button>
                    </div>
                  </div>
                </div>
              </template>
            </vx-card>
            <div class="vx-row">
              <div class="vx-col w-full mt-5">
                <vs-button class="mr-3 mb-2" color="primary" @click="done()"
                  >Go Back
                </vs-button>
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
      categoryTypes: [],
      applications: [],
      subcategoryLogo: [],
      previewImage: null,
      categoryId: "",
      categoryData: [],
      subCategoriesKey: "0",
    };
  },
  mounted() {},
  created() {
    this.getcategoryType();
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    getcategoryType() {
      axios.get("/api/categoryType").then((res) => {
        this.categoryTypes = res.data.data;
      });
    },
    addSubcategory() {
      this.categoryData.push({ name: "", done: false });
    },
    removeSubcategory(index) {
      this.categoryData.splice(index, 1);
    },

    submitSubCategory(categoryData, index) {
      let ref = `file${index}`;
      console.log("ref : ", ref);
      this.subcategoryLogo[index] = this.$refs[ref][0].files[0];
      console.log("subcategoryLogo[index]", this.subcategoryLogo[index]);
      if (!this.subcategoryLogo[index]) {
        this.sendSubcategoryRequest(index);
        return;
      }
      var component = this;
      var reader = new FileReader();
      reader.readAsDataURL(this.subcategoryLogo[index]);
      reader.onload = function () {
        component.subcategoryLogo[index] = reader.result;
        component.categoryData[index].image = reader.result;
        component.sendSubcategoryRequest(index);
      };
    },
    sendSubcategoryRequest(index) {
      this.categoryData[index].application_id = this.application_id ; 
      axios
        .post("/api/category/", this.categoryData[index])
        .then((res) => {
          this.showSuccess("category submited succesfully");
          this.categoryData[index].done = 1;
        })
        .catch((err) => {
          var errors = err.response.data.errors;
          Object.keys(errors).forEach((key) => {
            this.showError(errors[key]);
          });
        });
    },
    done() {
      this.$router.push({ name: "categoryList" });
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: "category is added succesfully",
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
    buttonClicked(index) {
      let ref = `file${index}`;
      this.$refs[ref][0].click();
    },
    fileUploaded(index) {
      let ref = `file${index}`;
    },
  },
};
</script>

<style scoped>
.upload {
  width: 38px;
  height: 38px;
}
</style>
