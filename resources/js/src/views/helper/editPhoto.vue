<template>
  <div class="container">
    <div class="vx-col w-full up">
      <div class="vx-row mb-6 upload">
          <div class="vx-col md:w-100 w-full mt-5">
              <vs-upload
              limit="1"
              :on-error="photoUploaded()"
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
              :src="image? image: 'https://idraksy.net/wp-content/uploads/2020/04/placeholder.png'"
              alt="content-img"
              class="responsive card-img-top company-imgg p-3"
              style="width:200px; height:200px;"
          />
      </div>
    </div>

  </div>
</template>


<script>
import axios from "../../axios.js";

export default {
  props : ['image'] ,  
  data() {
    return {

    };
  },
  mounted() {
  },
  created() {

  },

  methods: {
    photoUploaded(){
      console.log('here');
    }
  },
};
</script>

<style scoped>
.upload{
  position: absolute;
  z-index: 300;
  top: 150px;
  width: 250px;
  height: 200px;
  opacity: 0;
  left: 10px;
}
.logo{
  position: relative; 

}
</style>

