<template>
  <div>
    <div bg-white>
      <div class="vs-row flex">
        <div class="w-1/4 mb-6">
          <div class="search-page__search-bar flex items-center">
            <vs-input
              name="categories"
              icon-no-border
              placeholder="Search"
              class="w-full input-rounded-full"
              icon="icon-search"
              icon-pack="feather"
            />
          </div>
        </div>
      </div>
      <div class="vs-row flex">
        <div class="w-1/4 mb-6">
          <div class="search-page__search-bar flex items-center">
            <h2 class="text-greyy">categories</h2>
          </div>
        </div>
      </div>
    </div>

    <vx-card>
      <div class="flex">
        <div class="w-full float-right"></div>

        <div class>
          <vs-button
            icon-pack="feather"
            name="doctoradd"
            icon="icon-edit"
            class="mr-4"
            color="primary"
            :to="{ name: 'addCategory' }"
            >+ Add Category</vs-button
          >
        </div>
      </div>
    </vx-card>

    <div class="header my-5">
      <h3 class="p-5">application Category</h3>
    </div>
    <div class="flex flex-wrap justify-between items-center my-5">
      <!-- ITEMS PER PAGE -->
      <div
        v-if="categories"
        class="mb-4 md:mb-0 mr-4 ag-grid-table-actions-left"
      >
        <vs-dropdown vs-trigger-click class="cursor-pointer">
          <div
            class="p-4 border border-solid d-theme-border-grey-light rounded-full d-theme-dark-bg cursor-pointer flex items-center justify-between font-medium"
          >
            <span class="mr-2">
              {{ currentPage * paginationPageSize - (paginationPageSize - 1) }}
              -
              {{
                categories.length - currentPage * paginationPageSize > 0
                  ? currentPage * paginationPageSize
                  : categories.length
              }}
              of {{ categories.length }}
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

    <ag-grid-vue
      ref="agGridTable"
      header="application Category"
      :gridOptions="gridOptions"
      class="ag-theme-material w-100 my-4 ag-grid-table"
      :columnDefs="columnDefs"
      :defaultColDef="defaultColDef"
      :rowData="categories"
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
import applicationSelect from "../helper/applicationSelect";
import CellRendererLogo from "./cell-renderer/CellRendererLogo.vue";


export default {
  components: {
    AgGridVue,
    CellRendererLogo , 
    CellRendererActions,
    applicationSelect,
  },
  data() {
    return {
      component: this,
      categories: [],
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
        {
          headerName: "Name",
          field: "name",
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
        {
          headerName: "logo",
          field: "image",
          width: 225,
          cellRendererFramework: "CellRendererLogo" ,
        },
        {
          headerName: "Name",
          field: "name",
          width: 225,
          filter: true,
        },
        {
          headerName: "Name in arabic",
          field: "name_ar",
          width: 225,
          filter: true,
        },
        {
          headerName: "Type",
          field: "category_type.name",
          width: 225,
          filter: true,
        },

        {
          headerName: "Actions",
          field: "transactions",
          cellRendererFramework: "CellRendererActions",
          width: 225,
        },
      ],
      components: {
        CellRendererActions,
        CellRendererLogo , 
      },
    };
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
  watch: {
    application_id: function (application_id) {
      this.categories = this.allCategories.filter((category) => {
        return category.application_id == application_id;
      });
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
    this.getCategoryData();
  },
  methods: {
    getCategoryData() {
      axios
        .get("/api/category?application_id="+this.application_id)
        .then((res) => {
          this.categories = res.data.data;
        })
        .catch((err) => {});
    },
    deleteRecord(id) {
      var fun = this.deleteRecord;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirm Delete`,
        text: `You are about to delete this Doctor`,
        accept: () => {},
        acceptText: "Delete",
      });
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
