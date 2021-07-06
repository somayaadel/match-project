<!-- =========================================================================================
    File Name: CardStatistics.vue
    Description: Statistics Card
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div class="containe">
      <div class="vx-row">
        <div class="vx-col ">
          <vs-input
            
            v-model="filter.__contain_name"
            label-placeholder=" name"
          >
          </vs-input>
        </div>

        <div class="vx-col ">
          <vs-input
            v-model="filter.__contain_field5"
            label-placeholder=" field5"
          >
          </vs-input>
        </div>

        <div class="vx-col ">
          <vs-select
            label="gender"
            v-model="filter.__equal_gender"
            
          >
            <vs-select-item
              text="male"
              value="0"
            />
             <vs-select-item
              text="female"
              value="1"
            />
          </vs-select>
        </div>
        <div class="vx-col ">
          <h6>age : </h6>
          <vs-slider v-model="ageRange" />
        </div>

        <div class="vx-col ">
          <vs-select
            name="city"
            v-model="filter.__equal_city_id"
            label="city"
          >
            <vs-select-item
              :key="index"
              :value="item.id"
              :text="item.name"
              v-for="(item, index) in cities"
            />
          </vs-select>
        </div>
       
          
        <div class="vx-col ">
          
          <vs-button @click="search()">
            search
          </vs-button>
          
          <vs-button @click="reset()">
            reset
          </vs-button>
        </div>
      

      </div>
      <ag-grid-vue
      ref="agGridTable"
      :gridOptions="gridOptions"
      class="ag-theme-material w-100 my-4 ag-grid-table"
      :columnDefs="columnDefs"
      :defaultColDef="defaultColDef"
      :rowData="result"
      rowSelection="multiple"
      colResizeDefault="shift"
      :animateRows="true"
      :floatingFilter="true"
      :enableRtl="$vs.rtl"
    ></ag-grid-vue>
    <vs-pagination
      :total="last_page"
      :max="maxPageNumbers"
      v-model="currentPage"
    />

  </div>
</template>

<script>

import axios from "../axios.js";
import { AgGridVue } from "ag-grid-vue";
import "@sass/vuexy/extraComponents/agGridStyleOverride.scss";

export default {
  components: {
    AgGridVue,
  },
  data() {
    return {
      filter:{} , 
      ageRange : [10,100] , 
      result : [] , 
      cities : [] , 
      maxPageNumbers: 7,
      
      totalPages: 1, 
      pageSize: 15, 
      last_page : 1 ,
      currentPage : 1 , 
      
      gridApi: {
        
      },
      gridOptions: {},
      defaultColDef: {
        editable: true,
        sortable: true,
        resizable: true,
        suppressMenu: true,
      },
      
      columnDefs: [
      {
        headerName: "Name",
        field: "name",
 
      },
      {
        headerName: "Name in Arabic",
        field: "name_ar",
 
      },
      {
        headerName: "Gender",
        valueGetter :  this.getGender , 
      },
      {
        headerName: "Address",
        field: "user_data.address",
     
      },
      {
        headerName: "Birth Date",
        field: "user_data.birth_date",
        
      },

      ],

    };
  },
  watch:{
    currentPage : function(val){
      this.search() ; 
    }
  },
  mounted() {
    this.getCountryData() ; 
  },
  computed: {
     
      application_id(){
        return this.$store.state.application_id; 
      }, 
     
    },
  methods: {
    reset(){
      this.filter = {} ; 
    } , 
    getCountryData(){
        axios.get('/api/city/').then((res)=>{
            this.cities = res.data.data ; 
        }).catch(err=>{

        })
    },
    processData(){
      this.filter.__min_age = this.ageRange[0] ; 
      this.filter.__max_age = this.ageRange[1] ; 
    } , 
    search(){
        this.processData() ; 
        axios.post('/api/talanted_search?page=' + this.currentPage , this.filter).then(res=>{
          this.result = Object.keys(res.data.data.data).map((key) => {
            
            return res.data.data.data[key];

          })
          this.totalRecords = res.data.data.total ; 
          this.pageSize = res.data.data.per_page ; 
          this.last_page = res.data.data.last_page ; 
          
        })
    }, 
    getGender(params){
        return params.data.user_data.gender? 'female' : 'male' ; 
      },
    
  },
};
</script>

<style scoped>


</style>
