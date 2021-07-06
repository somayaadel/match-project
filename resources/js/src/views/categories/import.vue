
<template>
  <div>
    <div class="mb-8">
      <import-excel :onSuccess="loadDataInTable" />
    </div>
    <vx-card v-if="tableData.length && header.length">
      <vs-table stripe pagination :max-items="10" search :data="tableData">
        <template slot="header">
          <h4>{{ sheetName }}</h4>
        </template>

        <template slot="thead">
          <vs-th :sort-key="heading" v-for="heading in header" :key="heading">{{
            heading
          }}</vs-th>
        </template>

        <template slot-scope="{ data }">
          <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
            <vs-td
              :data="col"
              v-for="(col, indexcol) in data[indextr]"
              :key="indexcol + col"
            >
              {{ col }}
            </vs-td>
          </vs-tr>
        </template>
      </vs-table>
    </vx-card>
  </div>
</template>

<script>
import ImportExcel from "@/components/excel/ImportExcel.vue";
import axios from "../../axios.js";

export default {
  components: {
    ImportExcel,
  },
  data() {
    return {
      tableData: [],
      header: [],
      sheetName: "",
    };
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  methods: {
    loadDataInTable({ results, header, meta }) {
      this.header = header;
      this.tableData = results;
      this.sheetName = meta.sheetName;

      this.saveImportedCateg();
    },
    saveImportedCateg() {
      this.tableData.map((item) => {
        item.application_id = this.application_id;
      });
      console.log("here", this.tableData);
      axios
        .post("/api/importCateg", this.tableData)
        .then((res) => {})
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
