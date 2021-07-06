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
    data() {
        return {
            field: ""
        };
    },
    created() {
        this.field = this.params.data;
    },
    methods: {
        editRecord() {
            console.log(this.field);
        this.$router.push("/editField/" + this.field.id);
            
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
            /* Below two lines are just for demo purpose */
            axios
                .delete("/api/field/" + this.params.data.id)
                .then(res => {
                    this.showDeleteSuccess();
                    setTimeout(() => {
                        this.$root.$children[0]._data.key++ ; 
                    }, 300);
                })
                .catch(err => {
                    console.log(err);
                });
            /* UnComment below lines for enabling true flow if deleting user */
            // this.$store.dispatch("userManagement/removeRecord", this.params.data.id)
            //   .then(()   => { this.showDeleteSuccess() })
            //   .catch(err => { console.error(err)       })
        },
        showDeleteSuccess() {
            this.$vs.notify({
                color: "success",
                text: "The selected field was successfully deleted"
            });
        }
    }
};
</script>
