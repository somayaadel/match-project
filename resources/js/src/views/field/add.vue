<template>
  <div class="container">
    <div class="vx-row">
      <div class="vx-col w-full">
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

      <div class="vx-row mt-5 w-full">
        <!-- FORM WITH LABEL PLACEHOLDER WITH ICON-->
        <div class="vx-col w-full md:w-full sm:w-full">
          <vx-card>
            <div class="row px-3">
              <h3 class="text-title-grey title-patient py-5">New field</h3>

              <h1 class="my-3 text-title-grey">Add New field</h1>
            </div>

            <div class="vx-row mb-2">
              <div class="vx-col w-1/2">
                <vs-input
                  class="w-full my-5"
                  type="text"
                  icon-pack="feather"
                  icon="icon-user"
                  icon-no-border
                  label-placeholder=" Field Name"
                  v-model="fieldData.name"
                />
              </div>
              
              <div class="vx-col w-1/2">
                <vs-input
                  class="w-full my-5"
                  type="text"
                  icon-pack="feather"
                  icon="icon-edit"
                  icon-no-border
                  label-placeholder="Name in Arabic"
                  name="name_ar"
                  v-model="fieldData.name_ar"
                />
                <span
                  class="text-danger text-sm"
                  v-show="errors.has('name_ar')"
                  >{{ errors.first("name_ar") }}</span
                >
              </div>

              <div class="vx-col w-1/2">
                <vs-select
               
                name="service_id"
                v-validate="'required'"
                v-model="fieldData.type"
                label="type"
                class="w-full"
              >
                <vs-select-item
                  value="string"
                  text="string"
                />
                <vs-select-item
                  value="number"
                  text="number"
                />
                <vs-select-item
                  value="select"
                  text="select"
                />
                <vs-select-item
                  value="multi-select"
                  text="multi-select"
                />
              </vs-select>
            
              </div>

              <div class="vx-col w-1/2">
                <vs-select
                class="w-full"
                name="service_id"
                v-validate="'required'"
                v-model="fieldData.role_id"
                label="company or talanted"

              >
                <vs-select-item
                  v-for="(item,index) in roles"
                  :key="index"
                  :value="item.id"
                  :text="item.name"
                />
               
              </vs-select>
            
              </div>
              <div class="vx-col mt-5 w-1/2">

                <vs-switch v-model="fieldData.mandatory">
                  <span slot="on">mandatory</span>
                  <span slot="off">optional</span>
                </vs-switch>
              </div>


          <vx-card
            :title="fieldData.type + '  items'"
            class="vx-col w-full sm:w-full sm:w-full lg:w-full xl:w-full flex flex-col overflow-hidden my-5"
            v-if="fieldData.type=='select' || fieldData.type=='multi-select'"
          >
            <template class="overflow-hidden">
              <vs-button
                class="mb-2 float-right"
                type="gradient"
                icon="icon-plus"
                icon-pack="feather"
                radius
                color="primary"
                @click="addItem()"
              ></vs-button>

              <div class="vx-row w-full mb-2">
                <div
                  class="vx-col w-full"
                  :key="index"
                  v-for="(item, index) in fieldData.items"
                >
                  <div class="vx-row w-full mb-2">
                   
                    <vs-input
                      class="vx-col w-1/3"
                      type="text"
                      icon-pack="feather"
                      icon="icon-edit"
                      icon-no-border
                      v-validate="'required'"
                      v-model="item.name"
                      label-placeholder="name"
                    />

                    <vs-input
                      class="vx-col w-1/3"
                      type="text"
                      icon-pack="feather"
                      icon="icon-edit"
                      icon-no-border
                      v-validate="'required'"
                      v-model="item.name_ar"
                      label-placeholder="name in arabic"
                    />

                    <vs-button
                      class="vx-col w-1/3 float-right mt-4"
                      type="gradient"
                      icon="icon-trash"
                      icon-pack="feather"
                      radius
                      color="danger"
                      @click="removeItem(index)"
                    ></vs-button>
                  </div>
                </div>
              </div>
            </template>
          </vx-card>




            </div>
            
            <div class="vx-row">
              <div class="vx-col w-full mt-5">
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
  </div>
</template>


<script>
import axios from "../../axios.js";

export default {
  name: "imageUpload",
  data() {
    return {
      applicationFields: [],
      applications: [],
      products: [],
      companies: [],
      previewImage: null,

      programs: [],
      roles : [] , 
      users: [],
      searchQuery: "",
      fieldData: {
        name: "",
        name_ar:"" , 
        type :"" , 
        items : [] , 
      },
    };
  },
  watch: {
      application_id : function(val){
      }
      ,
  },
  mounted() {
  },
  created() {
      this.getCreatedData() ; 
  },
computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
      getCreatedData(){
        axios.get('/api/field/create').then(res=>{
          this.roles = res.data.roles ; 
        })
      },
    addSubcategory() {
      this.applicationFields.push({ name: "" });
    },
    removeSubcategory(index) {
      this.applicationFields.splice(index, 1);
    },
    submitData(){
      this.fieldData.application_id = this.application_id ; 
      this.$validator.validateAll().then((res) => {
          axios.post('/api/field' , this.fieldData).then(res=>{
            this.showSuccess("field has been created successfuly");
            setTimeout(()=>{
                this.$router.push({name: 'fieldList'})
            } , 300) ;
          })
          .catch(err=>{
              var errors = err.response.data.errors;
              Object.keys(errors).forEach((key) => {
                this.showError(errors[key]);
              });
          })
      }) ; 
    },
    addItem() {
      this.fieldData.items.push({});
    },
    removeItem(index) {
      this.fieldData.items.splice(index, 1);
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
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


