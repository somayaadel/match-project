<!-- =========================================================================================
    File Name: tableFilterSorter.vue
    Description: Add filter and sorting functionality to table
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div bg-white class="containe">
    <div class="vs-row flex">
      <div class="w-1/4 mb-6">
          <vs-select v-model="role_id" @input="roleChanged()">

            <vs-select-item  text="company" value="2" />
            <vs-select-item  text="talanted" value="3" />

          </vs-select>
      </div>
    </div>
    <div class="vs-row flex">
      <div class="w-1/4 mb-6">
        <div class="search-page__search-bar flex items-center">
          <h2 class="text-greyy">Package</h2>
        </div>
      </div>
    </div>
    <div class="float-right m-5">
      <vs-button
        icon-pack="feather"
        name="add"
        icon="icon-edit"
        class="mr-4 float-right m-5"
        color="primary"
        :to="{ name: 'addPackage' }"
        >+ Add Package</vs-button
      >
    </div>

    <div class="vx-row my-5">
      <div class="vx-col w-1/4" v-for="(item, index) in packages" :key="index">
        <vx-card class="p-2">
          <vs-avatar
            style="background: white"
            class="mx-auto my-6 block"
            size="110px"
            :src="item.logo"
          />
          <div class="text-center">
            <h4 class="text-grey">{{ item.name }}</h4>

            <h3 class="text-secondary py-5">{{ item.price }} EGP</h3>
            <p
              class="text-grey"
              v-for="(feature, index2) in item.features"
              :key="index2"
            >
              {{ feature.name }}
            </p>
          </div>

          <vs-button
            type="gradient"
            class="w-full mt-6"
            color="#7367F0"
            gradient-color-secondary="#1975b2"
            :to="{ path: 'editPackage/' + item.id }"
            >Edit</vs-button
          >
        </vx-card>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../../axios.js";

export default {
  
  data() {
    return {
      packages: [],
      role_id : 3 , 
     
    };
  },
  watch: {
    application_id: function (application_id) {
      this.packages = this.allPackages.filter((p) => {
        return p.application_id == application_id;
      });
    },
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  mounted() {
    this.getPackages();
  },
  methods: {
    getPackages() {
      axios
        .get("/api/package")
        .then((res) => {
          this.allPackages = res.data.data
          this.filterPackages() ; 


        })
        .catch((err) => {
          console.log(err);
        });
    },
    roleChanged(){
       this.filterPackages() ; 
    }, 
    filterPackages(){
        this.packages = JSON.parse(JSON.stringify(this.allPackages)).filter((p) => {
          return p.application_id == this.application_id && p.role_id == this.role_id;
        });
    }
  },
};
</script>
<style>
.text-grey {
  color: rgb(130, 134, 138, 0.8) !important;
}
</style>
