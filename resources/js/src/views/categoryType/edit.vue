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

            <vx-card
              title="Add New Category"
              class="vx-col w-full sm:w-full sm:w-full lg:w-full xl:w-full flex flex-col overflow-hidden my-5"
            >
              <div class="vx-row w-full mb-2">
                <div class="vx-row w-full mb-2">
                  <vs-input
                    class="vx-col w-full"
                    type="text"
                    icon-no-border
                    label-placeholder=" Category name"
                    name=" Categoryname"
                    v-model="categoryType.name"
                    v-validate="'required'"
                  />
                </div>
              </div>
            </vx-card>
            <div>
              <vs-button @click="submitCategoryType()">submit</vs-button>
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
export default {
  components: {},
  data() {
    return {
      categoryType: {
        name: "",
        application_id: "",
      },
      applications: [],
    };
  },
  mounted() {},
  created() {
    this.getCategoryTypeData();
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    getCategoryTypeData() {
      axios
        .get("/api/categoryType/" + this.$route.params.id)
        .then((res) => {
          this.categoryType = res.data.data;
        })
        .catch((err) => {});
    },
    submitCategoryType() {
      this.categoryType.application_id = this.application_id;
      axios
        .put("/api/categoryType/" + this.$route.params.id, this.categoryType)
        .then((res) => {
          this.categoryType = res.data.data;

          this.showSuccess("category Updated succesfully");
          this.$router.push({ name: "categoryTypeList" });
        })
        .catch((err) => {
          var errors = err.response.data.errors;
          Object.keys(errors).forEach((key) => {
            this.showError(errors[key]);
          });
        });
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: "category type is edited succesfully",
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
  },
};
</script>


