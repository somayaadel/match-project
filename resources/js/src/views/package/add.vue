<template>
  <div class="container">
    <div class="vx-row">
    
      <div class="vx-col w-1/4">
        <!-- <img src="@assets/images/logo/Pfizer-logo.png" alt /> -->
      </div>
    </div>
    <div class="row px-3 w-1/2">
      <h1 class="my-3 text-title-grey">Add New Package</h1>
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
                type="number"
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

            <div class="vx-row mb-6">
              <div class="vx-col md:w-100 w-full mt-5">
                <vs-upload
                  limit="1"
                  automatic
                  text="Add Package picture"
                  ref="ufile"
                  fileName="CODE"
                  action
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

              <div class="vx-row w-full mb-2">
                <div
                  class="vx-col w-full"
                  :key="index"
                  v-for="(item, index) in package_data.AllFeature"
                >
                  <div class="vx-row w-full mb-2">
                    <vs-select
                      
                      class="vx-col w-1/3 selectExample"
                      label="features"
                      name="featureName"
                      v-validate="'required'"
                      v-model="item.feature_id"
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
                      v-model="item.limitation"
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
            v-if="roleName=='talanted'"
            title="profile fields"
            class="vx-col w-full sm:w-full sm:w-full lg:w-full xl:w-full flex flex-col overflow-hidden my-5"
          >
          <vx-card >
            <vs-checkbox color="success" :disabled="oldFields[index].required=='1'" v-for="(item,index) in fields " :key="index" v-model="fields[index].required">{{item.name}}</vs-checkbox>
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
  name: "imageUpload",
  data() {
    return {
      applications: [],
      features: [],
      fields : [] , 
      roles : [] , 
      roleName : "" , 
      oldFields :[] ,
      package_data: {
        name: "",
        price: "",
        application_id: "",
        AllFeature: [],
        fields : [] , 
      },

      searchQuery: "",
    };
  },
  mounted() {},
  created() {
    this.getCreateData() ; 
  },
  computed: {
    application_id() {
        return this.$store.state.application_id;
    },
  },
  methods: {
    getCreateData(){
        axios.get('/api/package/create?application_id='+ this.application_id ).then(res=>{
            this.features = res.data.features ; 
            this.fields = res.data.fields  ; 
            this.roles = res.data.roles ; 
            this.oldFields = JSON.parse( JSON.stringify(res.data.fields)) ; 
        })
    },
    addSubcategory() {
      this.package_data.AllFeature.push({});
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
        .catch((err) => {
          console.log(err);
        });
    },
    getApplication() {
      axios
        .get("/api/application")
        .then((res) => {
          this.applications = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    submitData() {
      this.packageLogo = this.$refs.ufile.filesx[0];
        if (!this.$refs.ufile.filesx[0]) {
          this.sendPackagePostRequest();
          return;
        }
        var component = this;
        var reader = new FileReader();
        reader.readAsDataURL(this.packageLogo);
        reader.onload = function () {
          component.packageLogo = reader.result;
          component.package_data.logoFile = reader.result;
          component.sendPackagePostRequest();
        }
     
    },
    sendPackagePostRequest(){
        this.$validator.validateAll().then((res) => {
        this.package_data.features = this.package_data.AllFeature;
        this.package_data.fields = this.fields ; 
        this.package_data.application_id = this.application_id ; 
        
        this.package_data.fields = [];
        this.fields.forEach((element,index) => {
            if(this.fields[index].required && ! this.oldFields[index].required ){
              this.package_data.fields.push({ 'field_id' :this.fields[index].id }) ; 
            }
        });

        axios
          .post("/api/package", this.package_data)
          .then((res) => {
            this.showSuccess("package is created successfuly");
            this.$router.push({ name: "packageList" });
          })
          .catch((err) => {
            var errors = err.response.data.errors;
              Object.keys(errors).forEach(key => {
                  this.showError(errors[key]);
              });
          });
      });
    },
    roleChanged(){
      this.roles.forEach(role => {
          if(role.id==this.package_data.role_id)this.roleName = role.name ; 
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


