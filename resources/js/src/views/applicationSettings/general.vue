<template>
  <div class="container">
    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>system email</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input class="w-full" v-model="gereralData.email" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>phone</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input class="w-full" v-model="gereralData.phone" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>time zoon</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input class="w-full" v-model="gereralData.time_zone" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>member email verification</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-checkbox
          value="1"
          v-model="gereralData.member_email_verification"
        ></vs-checkbox>
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>member profile picture approved by admin</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-checkbox
          value="1"
          v-model="gereralData.member_profile_picture_admin_approve"
        ></vs-checkbox>
      </div>
    </div>

    <div class="vx-row">
      <div class="vx-col sm:w-2/3 w-full ml-auto">
        <vs-button class="mr-3 mb-2" @click="updateGeneral()">save</vs-button>
        <vs-button
          color="warning"
          type="border"
          class="mb-2"
          @click="
            input1 = input2 = input3 = input4 = input4 = '';
            check1 = false;
          "
          >Reset</vs-button
        >
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../../axios";
export default {
  data() {
    return {
      gereralData: {
        email: "",
        phone: "",
        time_zone: "",
        member_email_verification: 0,
        member_profile_picture_admin_approve: 0,
        application_id: "",
      },
    };
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    updateGeneral() {
      console.log("ccccc", this.application_id);
      this.gereralData.application_id = this.application_id;
      axios
        .put("/api/generalSetting/" + this.application_id, this.gereralData)
        .then((res) => {
          showSuccess("added successfully");
        })
        .catch(() => {});
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: "category is added succesfully",
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
<style lang="stylus" scoped>
.container {
  margin-top: 150px;
}
</style>
