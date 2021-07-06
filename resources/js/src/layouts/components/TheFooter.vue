<!-- =========================================================================================
    File Name: TheFooter.vue
    Description: Footer component
    Component Name: TheFooter
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template functional>
  <footer class="the-footer flex-wrap justify-between" :class="classes">
    <span>COPYRIGHT &copy; REBOOT</span>

    <!-- buyNow component -->
  </footer>
</template>

<script>
import BuyNow from "../../components/BuyNow.vue";

export default {
  name: "the-footer",
  props: {
    classes: {
      type: String,
    },
  },
  inject: {
    components: {},
  },
};
</script>
