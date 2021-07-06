<template>
  <div class="container">
    <div class="vx-row mb-6" v-for="(item, index) in allFaq" :key="index">
      <div class="vx-col w-1/3">
        <vs-input
          placeholder="question"
          v-model="item.question"
          place-holeer="dsf"
          class="w-full pt-3"
        />
      </div>
      <div class="vx-col w-2/3">
        <vs-textarea
          placeholder="answer"
          v-model="item.answer"
          class="w-full"
        />
      </div>
    </div>
    <div class="vx-row">
      <div class="vx-col sm:w-2/3 w-full ml-auto"></div>
    </div>
    <div class="vx-row">
      <div class="vx-col sm:w-1/2 w-full ml-auto">
        <vs-button class="mr-3 mb-2" @click="update()">save</vs-button>
      </div>
      <div class="vx-col sm:w-1/2 w-full ml-auto">
        <vs-button
          :key="questionKey"
          class="mb-2 float-right"
          type="gradient"
          icon="icon-plus"
          icon-pack="feather"
          radius
          color="primary"
          @click="addQuestion()"
        ></vs-button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../../axios";

export default {
  data() {
    return {
      allFaq: [],
      questionKey: "0",
    };
  },
  mounted() {
    this.getFAQ();
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    update() {
      this.allFaq.application_id = this.application_id;
      axios
        .post("/api/faq/", this.allFaq)
        .then((res) => {
          this.showSuccess("updated successfully");
        })
        .catch(() => {});
    },
    addQuestion() {
      this.allFaq.push({
        id: null,
        question: "",
        answer: "",
        application_id: this.application_id,
      });
    },
    getFAQ() {
      axios
        .get("/api/faq")
        .then((res) => {
          this.allFaq = res.data.data;
        })
        .catch(() => {});
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
<style lang="stylus" scoped>
.container {
  margin-top: 150px;
}
</style>
