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
        <div class="w-1/4 mb-6">
          <div class="search-page__search-bar flex items-center">
            <vs-input
              name="Categories"
              icon-no-border
              placeholder="Search"
              v-model="searchQuery"
              class="w-full input-rounded-full"
              icon="icon-search"
              icon-pack="feather"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="vx-col w-1/3">
          <h1 class="my-5 text-title-grey">Users</h1>
        </div>
      </div>
    </div>

    <vx-card>
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
                  users.length - currentPage * paginationPageSize > 0
                    ? currentPage * paginationPageSize
                    : users.length
                }}
                of {{ users.length }}
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
      :rowData="users"
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
import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";
import CellRenderPackage from "./cell-renderer/CellRenderPackage.vue";
import { AgGridVue } from "ag-grid-vue";
import "@sass/vuexy/extraComponents/agGridStyleOverride.scss";
import CellRendererActions from "./cell-renderer/CellRendererActions.vue";
import CellRendererProfileImage from "./cell-renderer/CellRendererProfileImage.vue";

export default {
  components: {
    AgGridVue,
    CellRenderPackage,
    CellRendererActions,
    CellRendererProfileImage,
  },
  props: {
    mode: "",
  },
  data() {
    return {
      users: [],
      subProducts: [],
      channel_name: "",
      channel_fields: [],
      channel_entries: [],
      allUsers : [] , 
      parse_header: [],
      parse_csv: [],
      sortOrders: {},
      sortKey: "",
      searchQuery: "",
      gridOptions: {},
      maxPageNumbers: 7,
      api: "",
      gridApi: null,
      defaultColDef: {
        sortable: false,
        editable: false,
        resizable: false,
        suppressMenu: false,
      },
      columnDefs: [
        {
          headerName: "profile_image",
          field: "profile_image",
          width: 180,
          cellRendererFramework: "CellRendererProfileImage",
        },
        {
          headerName: "name",
          field: "name",
          width: 225,
          filter: true,
        },
        {
          headerName: "Application Name",
          field: "application.name",
          width: 225,
          filter: true,
        },

        {
          headerName: "Email",
          field: "email",
          filter: true,
          width: 225,
        },
        {
          headerName: "Role",
          field: "role.name",
          filter: true,
          width: 225,
        },
        {
          headerName: "Package",
          field: "transactions",
          cellRendererFramework: "CellRenderPackage",
          width: 225,
        },
        {
          headerName: "actions",
          field: "transactions",
          cellRendererFramework: "CellRendererActions",
          width: 225,
        },
      ],
      components: {
        CellRenderPackage,
        CellRendererActions,
        CellRendererProfileImage,
      },
    };
  },
  watch: {
    "application_id": function (newVal, oldVal) {
      this.filterUsers();
    },
    mode: function (mode) {
      this.getUsers();
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
  beforeUpdate() {
    this.getUsers();
  },

  mounted() {
    this.getUsers();
    this.gridApi = this.gridOptions.api;
  },
  methods: {
    filterUsers(){
      console.log('heeeeeeee');
      this.users = JSON.parse(JSON.stringify(this.allUsers)).filter((user) => {
        return user.application_id == this.application_id;
        this.$root.$children[0]._data.key++;

      });
      console.log(this.users);
    },
    addSubProducts() {
      this.subProducts.push({ name: "" });
    },
    removeSubProducts(index) {
      this.subProducts.splice(index, 1);
    },
    getUsers() {
      var api = "";
      var routeName = this.mode;
      if (routeName == "company") {
        api = "/api/company_users";
      } else if (routeName == "free") {
        api = "/api/free_users";
      } else if (routeName == "premium") {
        api = "/api/premium_users";
      } else if (routeName == "blocked") {
        api = "/api/blocked_users";
      } else if (routeName == "deleted") {
        api = "/api/deleted_users";
      }

      console.log("new api : ", this.api);
      if (api == this.api) return;
      this.api = api;
      axios
        .get(api)
        .then((res) => {
          this.users = res.data.data;
          this.allUsers = JSON.parse(JSON.stringify(res.data.data));
          this.filterUsers() ; 
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
