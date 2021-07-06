<template>
  <div class="flex items-center">
    <vs-button
      icon-pack="feather"
      icon-no-border
      @click="showFeatures()"
      color="primary"
      type="border"
      >Features</vs-button
    >

    <vs-popup
      classContent="popup-example"
      title="deatails"
      :active.sync="detailsPopup"
    >
      <vs-table pagination :max-items="6" search :data="features">
        <template slot="thead">
          <vs-th sort-key="name" class="tableHead">name</vs-th>
          <vs-th sort-key="type" class="tableHead">type</vs-th>
          <vs-th sort-key="type" class="tableHead">limitation</vs-th>
        </template>

        <template>
          <vs-tr
            :key="indextr"
            v-for="(tr, indextr) in features"
            class="vs-align-center"
          >
            <vs-td>
              {{ tr.name }}
            </vs-td>

            <vs-td>
              {{ tr.service.name }}
            </vs-td>
            <vs-td>
              {{ tr.pivot.limitation }}
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
      features: [],
    };
  },

  components: {},
  methods: {
    showFeatures() {
      this.features = this.params.data.features;
      this.detailsPopup = true;
    },
  },
};
</script>
<style >
.field {
  margin: 500px !important;
}
</style>
