<template>
  <div class="container">
    <quill-editor
      v-model="data.terms"
      ref="myQuillEditor"
      :options="editorOption"
      @blur="onEditorBlur($event)"
      @focus="onEditorFocus($event)"
      @ready="onEditorReady($event)"
    >
    </quill-editor>
    <div class="vx-row">
      <div class="vx-col sm:w-2/3 w-full ml-auto">
        <vs-button class="mr-3 mb-2" @click="updateTerms()">save</vs-button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "../../axios";

import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";
import { quillEditor } from "vue-quill-editor";

export default {
  components: {
    quillEditor,
  },
  data() {
    return {
      editorOption: {},
      data: {
        terms: "",
      },
    };
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    updateTerms() {
      console.log("ccccc", this.application_id);
      this.data.application_id = this.application_id;
      axios
        .put("/api/generalSetting/" + this.application_id, this.data)
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
