<template>
    <div :style="{ direction: $vs.rtl ? 'rtl' : 'ltr' }">
        <feather-icon
            icon="Edit3Icon"
            svgClasses="h-5 w-5 mr-4 hover:text-primary cursor-pointer"
            @click="editRecord"
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
        editRecord() {
            this.$router
                .push("/editCategory/" + this.params.data.id)
                .catch(() => {});
        },
        confirmDeleteRecord() {
            this.$vs.dialog({
                type: "confirm",
                color: "danger",
                title: `Confirm Delete`,
                text: `You are about to delete "${this.params.data.name}"`,
                accept: this.deleteRecord,
                acceptText: "Delete"
            });
        },
        deleteRecord() {
            axios
                .delete("api/category/" + this.params.data.id)
                .then(res => {
                    console.log(res.data.data);
                    this.showDeleteSuccess();
                    setTimeout(() => {
                        this.$root.$children[0]._data.key++
                    }, 300);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        showDeleteSuccess() {
            this.$vs.notify({
                color: "success",
                title: "User Deleted",
                text: "The selected user was successfully deleted"
            });
        }
    }
};
</script>
