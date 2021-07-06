<template>
  <quill-editor
    v-model="content"
    ref="myQuillEditor"
    :options="editorOption"
    @blur="onEditorBlur($event)"
    @focus="onEditorFocus($event)"
    @ready="onEditorReady($event)"
  >
  </quill-editor>
</template>

<script>
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
      content:
        "asfdjh asjdkfsakjdfsadjf adsf sad fljad slfadsjf sad f dsafdslflj;dasf ljaituiwetr",
    };
  },
};
</script>
<style lang="stylus" scoped>
.container {
  margin-top: 150px;
}
</style>
