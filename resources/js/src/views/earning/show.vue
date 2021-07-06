
<template>
    <div class="container">
        <div class="vx-row">
            <div class="vx-row mt-5 w-full">
                <div class="vx-col w-full md:w-full sm:w-full">
                    <vx-card>
                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>Name</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <span>juan</span>
                        </div>
                      </div>

                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>date</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <span>10/10/2020</span>
                        </div>
                      </div>

                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>payment type</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <span>fawry</span>
                        </div>
                      </div>

                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>amount</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <span>100$</span>
                        </div>
                      </div>
                      

                      <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                          <span>package</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                          <span>gold</span>
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
import Datepicker from 'vuejs-datepicker';
export default {
     mounted() {
    },
    data() {
        return{
        }
    },
    components:{
    },
    methods:{
 
    }
}
</script>

<style scoped>
  .container{
    margin-top: 100px;
  }
</style>