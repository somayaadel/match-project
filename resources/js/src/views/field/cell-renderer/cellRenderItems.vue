<template>
    <div class="flex items-center" v-if="items && items.length>0" >
        <vs-button 
            icon-pack="feather"
            icon-no-border
            @click="showItems()"
            color="primary"
            type="border"
            >items</vs-button
        >

        <vs-popup
            
            classContent="popup-example"
            title="items"
            :active.sync="itemsPopup"
        >
            <vs-table pagination :max-items="6" search :data="items">
                <template slot="thead">
                    <vs-th sort-key="name" class="tableHead">name</vs-th>
                    <vs-th sort-key="name" class="tableHead">arabic name</vs-th>
                </template>

                <template>
                    <vs-tr
                        :key="indextr"
                        v-for="(tr, indextr) in items"
                        class="vs-align-center"
                    >
                        <vs-td>
                            {{ tr.name }}
                        </vs-td>
                        <vs-td>
                            {{ tr.name_ar }}
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
            itemsPopup: false,
            
            items: []
        };
    },

    components: {},
    methods: {
        showItems() {
            this.itemsPopup = true;
        }
    },
    created(){
        this.items = this.params.data.items ; 
    }
};
</script>
<style>
.field {
    margin: 500px !important;
}
</style>
