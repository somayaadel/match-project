<template>
  <div class="container">
    <div class="vs-row">
      <div class="vx-row mb-2">
        <div class="vx-col w-1/4">
          <label class=""><b> subject</b></label>
        </div>
        <div class="vx-col w-1/2">
          <vs-input
            type="text "
            v-model="emailTemplate.subject"
            class="w-full"
          />
        </div>
      </div>
      <div class="vx-row mb-2">
        <div class="vx-col w-1/4">
          <label class=""><b>Message</b></label>
        </div>
        <div class="vx-col w-1/2">
          <vs-textarea
            class="w-full"
            type="text"
            row="10"
            placeholder="Message"
            v-model="emailTemplate.body"
          />
        </div>
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col w-full">
        <vs-button class="mr-3 mb-2" color="primary" @click="submitData()"
          >Submit</vs-button
        >
      </div>
    </div>
  </div>
</template>
<script>
import axios from "../../../axios";

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
  props: ["type"],
  mounted() {
    this.getData();
  },
  methods: {
    submitData() {
      this.emailTemplate.type = this.type;
      axios
        .put("api/emailTemplate/1/?type=" + this.type, this.emailTemplate)
        .then((res) => {
          this.emailTemplate = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getData() {
      axios
        .get("api/emailTemplate/1/?type=" + this.type)
        .then((res) => {
          this.emailTemplate = res.data.data;
        })
        .catch((err) => {
          console.log(err);
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
