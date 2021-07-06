<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-col w-3/4"></div>
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h3 class="text-title-grey title-patient py-5">edit Package</h3>
      <h1 class="my-3 text-title-grey">edit Package</h1>
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
                v-validate="'required'"
                icon-no-border
                v-model="package_data.name"
                label-placeholder=" Name"
              />
            </div>
            <div class="vx-col w-full">
              <vs-input
                class="w-full"
                type="text"
                icon-pack="feather"
                icon="icon-user"
                v-validate="'required'"
                icon-no-border
                v-model="package_data.name_ar"
                label-placeholder="Name in arabic"
              />
            </div>
            <div class="vx-col w-full">
              <vs-input
                class="w-full"
                type="text"
                icon-pack="feather"
                icon="icon-user"
                icon-no-border
                v-validate="'required'"
                v-model="package_data.price"
                label-placeholder=" price"
              />
            </div>

            <div class="vx-col w-full">
              <vs-input
                class="w-full"
                type="number"
                icon-pack="feather"
                icon="icon-user"
                icon-no-border
                v-validate="'required'"
                v-model="package_data.duration"
                label-placeholder="duration in days"
              />
            </div>

            <div class="vx-col w-full">
              <vs-select
                class="vx-col w-1/3 selectExample"
                label="roles"
                name="role"
                v-validate="'required'"
                v-model="package_data.role_id"
                label-placeholder=" role"
                @input="roleChanged()"
              >
                <vs-select-item
                  :key="index"
                  :value="item.id"
                  :text="item.name"
                  v-for="(item, index) in roles"
                />
              </vs-select>
            </div>

            <div class="vx-col w-full up">
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
                    package_data.logo
                      ? package_data.logo
                      : 'https://idraksy.net/wp-content/uploads/2020/04/placeholder.png'
                  "
                  alt="content-img"
                  class="responsive card-img-top company-imgg p-3"
                  style="width: 200px; height: 200px"
                />
              </div>
            </div>
          </div>
          <vx-card
            title="Add More Feature"
            class="vx-col w-full sm:w-full sm:w-full lg:w-full xl:w-full flex flex-col overflow-hidden my-5"
          >
            <template class="overflow-hidden">
              <vs-button
                class="mb-2 float-right"
                type="gradient"
                icon="icon-plus"
                icon-pack="feather"
                radius
                v-validate="'required'"
                color="primary"
                @click="addSubcategory()"
              ></vs-button>

              <div class="vx-row w-full mb-2" :key="featuresKey">
                <div
                  class="vx-col w-full"
                  :key="index"
                  v-for="(item, index) in package_data.AllFeature"
                >
                  <div class="vx-row w-full mb-2">
                    <vs-select
                      autocomplete
                      class="vx-col w-1/3 selectExample"
                      label="features"
                      name="featureName"
                      v-validate="'required'"
                      v-model="item.pivot.feature_id"
                      label-placeholder=" featureName"
                    >
                      <vs-select-item
                        :key="index"
                        :value="item.id"
                        :text="item.name"
                        v-for="(item, index) in features"
                      />
                    </vs-select>
                    <vs-input
                      class="vx-col w-1/3"
                      type="number"
                      icon-pack="feather"
                      icon="icon-edit"
                      icon-no-border
                      v-validate="'required'"
                      v-model="item.pivot.limitation"
                      label-placeholder="limitation"
                    />

                    <vs-button
                      class="vx-col w-1/3 float-right mt-4"
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

          <vx-card
            v-if="roleName == 'talanted'"
            title="profile fields"
            class="vx-col w-full sm:w-full sm:w-full lg:w-full xl:w-full flex flex-col overflow-hidden my-5"
          >
            <vx-card>
              <vs-checkbox
                color="success"
                :disabled="oldFields[index].required == '1'"
                v-for="(item, index) in fields"
                :key="index"
                v-model="fields[index].required"
                >{{ item.name }}</vs-checkbox
              >
            </vx-card>
          </vx-card>

          <div class="vx-row">
            <div class="vx-col w-full">
              <vs-button class="mr-3 mb-2" color="danger" @click="submitData()"
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
  data() {
    return {
      roleName: "",
      featuresKey: 0,
      applications: [],
      features: [],
      fields: [],
      oldFields: [],
      roles: [],
      package_data: {
        name: "",
        price: "",
        application_id: "",
        AllFeature: [],
        fields: [],
      },
      packageLogo: "",
      searchQuery: "",
    };
  },
  mounted() {},
  created() {
    this.getCreateData();
    this.getFeatures();
    this.getApplication();
    this.getPackageData();
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    getCreateData() {
      axios
        .get("/api/package/create?application_id=" + this.application_id)
        .then((res) => {
          this.features = res.data.features;
          this.fields = res.data.fields;
          this.roles = res.data.roles;
          this.oldFields = JSON.parse(JSON.stringify(res.data.fields));
          console.log("fields : ", this.fields);
        });
    },
    addSubcategory() {
      this.package_data.AllFeature.push({ pivot: {} });
      this.featuresKey++;
    },
    removeSubcategory(index) {
      this.package_data.AllFeature.splice(index, 1);
    },
    getFeatures() {
      axios
        .get("/api/feature")
        .then((res) => {
          this.features = res.data.data;
        })
        .catch((err) => {});
    },
    getApplication() {
      axios
        .get("/api/application")
        .then((res) => {
          this.applications = res.data.data;
          console.log("applications", this.applications);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPackageData() {
      axios.get("/api/package/" + this.$route.params.id).then((res) => {
        this.package_data = res.data.data;
        this.package_data.AllFeature = this.package_data.features;
        this.roleChanged();
        this.featuresKey++;
        this.updatePackageFields();
      });
    },
    updatePackageFields() {
      this.fields.forEach((field) => {
        this.package_data.fields.forEach((actualField) => {
          if (field.id == actualField.id) {
            field.required = true;
          }
        });
      });
    },
    submitData() {
      this.$validator.validateAll().then((res) => {
        for (var i = 0; i < this.package_data.features.length; i++) {
          this.package_data.features[i].feature_id = this.package_data.features[
            i
          ].pivot.feature_id;
          this.package_data.features[i].package_id = this.package_data.features[
            i
          ].pivot.package_id;
          this.package_data.features[i].limitation = this.package_data.features[
            i
          ].pivot.limitation;
        }
        this.package_data.fields = [];
        this.fields.forEach((element, index) => {
          if (this.fields[index].required && !this.oldFields[index].required) {
            this.package_data.fields.push({ field_id: this.fields[index].id });
          }
        });
        this.packageLogo = this.$refs.ufile.filesx[0];
        if (!this.$refs.ufile.filesx[0]) {
          this.sendPackagePutRequest();
          return;
        }
        var component = this;
        var reader = new FileReader();
        reader.readAsDataURL(this.packageLogo);
        reader.onload = function () {
          component.packageLogo = reader.result;
          component.package_data.logoFile = reader.result;
          component.sendPackagePutRequest();
        };
      });
    },
    sendPackagePutRequest() {
      axios
        .put("/api/package/" + this.$route.params.id, this.package_data)
        .then((res) => {
          console.log(res.data);
          this.$router.push({ name: "packageList" });
          // this.$router.go();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    roleChanged() {
      this.roles.forEach((role) => {
        if (role.id == this.package_data.role_id) this.roleName = role.name;
      });
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: "package status",
        text: msg,
        position: "top-right",
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
