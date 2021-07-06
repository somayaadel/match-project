<template>
  <div class="container">
    <div class="mt-5">
      <vue-tabs direction="vertical w-full">
        <v-tab title="password reset email "
          ><mailTemplate type="password reset" />
        </v-tab>
        <v-tab title="package purchase email"
          ><mailTemplate type="package purchase email" />
        </v-tab>
        <v-tab title="user email verification"
          ><mailTemplate type="email verification" />
        </v-tab>
      </vue-tabs>
    </div>
  </div>
</template>

<script>
import { VueTabs, VTab } from "vue-nav-tabs";
import axios from "../../../axios";
import mailTemplate from "./mailTemplate.vue";

export default {
  data() {
    return {
      emailTemplate: {
        subject: "",
        type: "",
        body: "",
      },
    };
  },
  components: {
    mailTemplate,
    VueTabs,
    VTab,
  },
};
</script>
<style lang="stylus" scoped>
.container {
  margin-top: 150px;
}
</style>
