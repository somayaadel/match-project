<template>
  <div class="container">
      <div class="vx-col w-full py-5">
        <vs-select
          @input="applicationChanged"
          class="selectExample w-full"
          label="application"
          name="service_id"
          v-validate="'required'"
          v-model="applicationId"
          label-placeholder=" application"
        >
          <vs-select-item
            :key="index"
            :value="item.id"
            :text="item.name"
            v-for="(item, index) in applications"
          />
        </vs-select>
      </div>
  </div>
</template>


<script>
import axios from "../../axios.js";

export default {
  data() {
    return {
      applicationId : "" , 
      applications : [] , 
    };
  },
  mounted() {
      this.getApplications() ;  
  },
  created() {

  },

  methods: {
      getApplications(){
          axios.get('/api/application/').then(res=>{
              this.applications = res.data.data ; 
          }).catch(err=>{
              console.log(err);
          })
      }, 
      applicationChanged(){
          this.$emit('applicationChanged' , this.applicationId) ; 
      }, 
  },
};
</script>


