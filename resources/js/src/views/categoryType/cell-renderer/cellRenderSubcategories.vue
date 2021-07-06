<template>
    <div class="flex items-center">
        <vs-button
            icon-pack="feather"
            icon-no-border
            @click="showSubcategories()"
            color="primary"
            type="border"
            >subcategories</vs-button
        >

        <vs-popup
            classContent="popup-example"
            title="deatails"
            :active.sync="detailsPopup"
        >
            <vs-table pagination :max-items="6" search :data="subcategories">
                <template slot="thead">
                    <vs-th sort-key="name" class="tableHead">name</vs-th>
                    <vs-th sort-key="name" class="tableHead">image</vs-th>
                </template>

                <template>
                    <vs-tr
                        :key="indextr"
                        v-for="(tr, indextr) in subcategories"
                        class="vs-align-center"
                    >
                        <vs-td>
                            {{ tr.name }}
                        </vs-td>

                        <vs-td>
                            <div class="logo">
                                <img
                                    :src="tr.logo"
                                    alt="content-img"
                                    class="responsive card-img-top company-imgg p-3"
                                    style="width:100px; hight:30px"
                                />
                            </div>
                        </vs-td>

                    </vs-tr>
                </template>
            </vs-table>
        </vs-popup>
    </div>
</template>

<script>
import axios from "../../../axios";
export default {
    name: "CellRendererLink",
    data() {
        return {
            userRole: JSON.parse(localStorage.getItem("userInfo")).userRole,
            detailsPopup: false,
            singleCode: null,
            subcategories: []
        };
    },

    components: {},
    methods: {
        showSubcategories() {
            this.subcategories = this.params.data.subcategories;
            this.detailsPopup = true;
        }
    }
};
</script>
<style>
.field {
    margin: 500px !important;
}
</style>
