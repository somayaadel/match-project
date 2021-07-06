<template>
  <div :style="{ direction: $vs.rtl ? 'rtl' : 'ltr' }">
    <feather-icon
      icon="UserIcon"
      svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
      @click="profile"
    />
    <feather-icon
      icon="SlashIcon"
      v-if="!params.data.blocked"
      svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
      @click="confirmTogleBlockRecord"
    />
    <feather-icon
      icon="UnlockIcon"
      v-if="params.data.blocked"
      svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
      @click="confirmTogleBlockRecord"
    />
    <feather-icon
      icon="Trash2Icon"
      svgClasses="h-5 w-5 hover:text-danger cursor-pointer"
      @click="confirmDeleteRecord"
    />
  </div>
</template>

<script>
import axios from "../../../axios";
export default {
  name: "CellRendererActions",
  methods: {
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirm Delete`,
        text: `You are about to delete "${this.params.data.name}"`,
        accept: this.deleteRecord,
        acceptText: "Delete",
      });
    },
    confirmTogleBlockRecord() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirm Block`,
        text:
          "You are about to " +
          (this.params.data.blocked == 1 ? "unblock " : "block ") +
          this.params.data.name,
        accept: this.toggleBlockRecord,
        acceptText: "confirm",
      });
    },
    profile() {
      console.log("gdgdgdg");
      this.$router.push({ path: "showUser/" + this.params.data.id });
    },
    deleteRecord() {
      axios.delete("api/user/" + this.params.data.id).then((res) => {
        this.showDeleteSuccess(
          "The selected user was successfully deleted from the application"
        );
        setTimeout(() => {
          this.$root.$children[0]._data.key++;
        }, 300);
      });
    },
    toggleBlockRecord() {
      axios
        .post("api/user/" + this.params.data.id + "/toggle-block")
        .then((res) => {
          this.showDeleteSuccess(
            "The selected user was successfully blocked from the application"
          );
          setTimeout(() => {
            this.$root.$children[0]._data.key++;
          }, 300);
        });
    },
    showDeleteSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: "User Deleted",
        text: msg,
      });
    },
  },
};
</script>
