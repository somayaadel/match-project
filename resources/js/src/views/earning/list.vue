<!-- =========================================================================================
    File Name: tableFilterSorter.vue
    Description: Add filter and sorting functionality to table
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div>
    <div bg-white>
      <div class="vs-row flex">
        <div class="w-1/4 mb-6"></div>
      </div>
      <div class="vs-row flex">
        <div class="w-1/4 mb-6">
          <div class="search-page__search-bar flex items-center"></div>
        </div>
      </div>
    </div>

    <vx-card>
      <div class="flex">
        <div class="w-full float-right">
          <h3>Earning</h3>
        </div>
      </div>
      <div class="flex flex-wrap justify-between items-center">
        <!-- ITEMS PER PAGE -->
        <div class="mb-4 md:mb-0 mr-4 ag-grid-table-actions-left">
          <vs-dropdown vs-trigger-click class="cursor-pointer">
            <div
              class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium"
            >
              <span class="mr-2">
                {{
                  currentPage * paginationPageSize - (paginationPageSize - 1)
                }}
                -
                {{
                  earnings.length - currentPage * paginationPageSize > 0
                    ? currentPage * paginationPageSize
                    : earnings.length
                }}
                of {{ earnings.length }}
              </span>
              <feather-icon icon="ChevronDownIcon" svgClasses="h-4 w-4" />
            </div>
            <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
            <vs-dropdown-menu>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(20)">
                <span>20</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(50)">
                <span>50</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(100)">
                <span>100</span>
              </vs-dropdown-item>
              <vs-dropdown-item @click="gridApi.paginationSetPageSize(150)">
                <span>150</span>
              </vs-dropdown-item>
            </vs-dropdown-menu>
          </vs-dropdown>
        </div>
      </div>
    </vx-card>
    <ag-grid-vue
      ref="agGridTable"
      :gridOptions="gridOptions"
      class="ag-theme-material w-100 my-4 ag-grid-table"
      :columnDefs="columnDefs"
      :defaultColDef="defaultColDef"
      :rowData="earnings"
      rowSelection="multiple"
      colResizeDefault="shift"
      :animateRows="true"
      :floatingFilter="true"
      :pagination="true"
      :paginationPageSize="paginationPageSize"
      :suppressPaginationPanel="true"
      :enableRtl="$vs.rtl"
    ></ag-grid-vue>
    <vs-pagination
      :total="totalPages"
      :max="maxPageNumbers"
      v-model="currentPage"
    />
  </div>
</template>


<script>
import axios from "../../axios.js";
import { AgGridVue } from "ag-grid-vue";
import "@sass/vuexy/extraComponents/agGridStyleOverride.scss";
import CellRendererActions from "./cell-renderer/CellRendererActions.vue";
export default {
  components: {
    AgGridVue,
    CellRendererActions,
  },
  data() {
    return {
      earnings: [],
      searchQuery: "",

      sortOrders: {},
      sortKey: "",
      searchQuery: "",
      maxPageNumbers: 7,
      doctorsTabel: [],
      gridApi: null,
      gridOptions: {},
      defaultColDef: {
        editable: true,
        sortable: true,
        resizable: true,
        suppressMenu: true,
      },
      columnDefs: [
        ,
        {
          headerName: "User Name",
          field: "user.name",
          width: 225,
          filter: true,
        },
        {
          headerName: "Date",
          field: "updated_at",
          width: 225,
          filter: true,
        },
        {
          headerName: "payment type",
          field: "payment_method.name",
          width: 225,
          filter: true,
        },
        {
          headerName: "amount",
          field: "package.price",
          width: 225,
          filter: true,
        },
        {
          headerName: "package",
          field: "package.name",
          width: 225,
          filter: true,
        },

        {
          headerName: "Actions",
          field: "transactions",
          cellRendererFramework: "CellRendererActions",
          width: 150,
        },
      ],
      components: {
        CellRendererActions,
      },
    };
  },
  watch: {
    "$store.state.windowWidth"(val) {
      if (val <= 576) {
        this.maxPageNumbers = 4;
        this.gridOptions.columnApi.setColumnPinned("email", null);
      } else this.gridOptions.columnApi.setColumnPinned("email", "left");
      gridOptions.copyHeadersToClipboard = true;
    },
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
    paginationPageSize() {
      if (this.gridApi) return this.gridApi.paginationGetPageSize();
      else return 50;
    },
    totalPages() {
      if (this.gridApi) return this.gridApi.paginationGetTotalPages();
      else return 0;
    },
    currentPage: {
      get() {
        if (this.gridApi) return this.gridApi.paginationGetCurrentPage() + 1;
        else return 1;
      },
      set(val) {
        this.gridApi.paginationGoToPage(val - 1);
      },
    },
  },
  mounted() {
    this.gridApi = this.gridOptions.api;
    // console.log(this.gridApi);
    /* =================================================================
            NOTE:
            Header is not aligned properly in RTL version of agGrid table.
            However, we given fix to this issue. If you want more robust solution please contact them at gitHub
          ================================================================= */
    if (this.$vs.rtl) {
      const header = this.$refs.agGridTable.$el.querySelector(
        ".ag-header-container"
      );
      header.style.left =
        "-" + String(Number(header.style.transform.slice(11, -3)) + 9) + "px";
    }
    this.getEarningData();
  },
  methods: {
    getEarningData() {
      axios
        .get("/api/earning/")
        .then((res) => {
          this.earnings = res.data.data;
        })
        .catch((err) => {});
    },

    showDeleteSuccess() {
      this.$vs.notify({
        color: "success",
        title: "User Deleted",
        text: "The selected user was successfully deleted",
      });
      //  this.$router.go(0);
      // this.$forceUpdate();
    },
  },
};
</script>
