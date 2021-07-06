<!-- =========================================================================================
    File Name: tableFilterSorter.vue
    Description: Add filter and sorting functionality to table
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div :key="key" @rerender="rerender()">
    <div bg-white>
      <div class="vs-row flex">
        <div class="w-1/4 mb-6">
          <div class="search-page__search-bar flex items-center">
            <vs-input
              name="Fields"
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
            <h2 class="text-greyy">Fields</h2>
            
          </div>
        </div>
      </div>
    </div>

    <vx-card>
      <div class="flex">
        <div class="w-full float-right">
          <h3>Fields</h3>
        </div>


        <div class>
          <vs-button
            icon-pack="feather"
            name="doctoradd"
            icon="icon-edit"
            class="mr-4"
            color="primary"
            :to="{ name: 'addField' }"
            >+ Add Fields</vs-button
          >
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
                  fields.length - currentPage * paginationPageSize > 0
                    ? currentPage * paginationPageSize
                    : fields.length
                }}
                of {{ fields.length }}
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
      :rowData="fields"
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
import cellRenderItems from "./cell-renderer/cellRenderItems.vue";

export default { 
  components: {
    AgGridVue,
     cellRenderItems , 
    CellRendererActions ,
  },
  data() {
    return {
      fields : [] , 
      allFields : [] , 
      searchQuery: "",
     
      
      sortOrders: {},
      sortKey: "",
      key : 0 , 
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
          headerName: "Name in Arabic",
          field: "name_ar",
          width: 225,
          filter: true,
        },
        {
          headerName: "type",
          field: "type",
          width: 225,
          filter: true,
        },
        {
          headerName: "Gender",
          valueGetter :  this.getMandatory , 
        },
        {
          headerName: "items",
          field: "items",
          width: 225,
          cellRendererFramework: "cellRenderItems",
        },
        
        {
            headerName: "Actions",
            field: "transactions",
            cellRendererFramework: "CellRendererActions",
            width: 150
        }

      ],
      components: {
          CellRendererActions , 
          cellRenderItems
      }
    };
  },
    watch: {
      application_id : function(val){
          this.filterFields() ; 
      }
      ,
      "$store.state.windowWidth"(val) {
        if (val <= 576) {
          this.maxPageNumbers = 4;
          this.gridOptions.columnApi.setColumnPinned("email", null);
        } else this.gridOptions.columnApi.setColumnPinned("email", "left");
        gridOptions.copyHeadersToClipboard = true
      },
    },
    computed: {
      application_id(){
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
      this.getFieldData()
    },
    methods: {
      getFieldData(){
          axios.get('/api/field/').then((res)=>{
              this.fields = res.data.data ; 
              this.allFields = res.data.data ; 
              this.filterFields() ; 
          }).catch(err=>{

          })
      },
      csvJSON(csv) {
        var vm = this;
        var lines = csv.split("\n");
        var result = [];
        var headers = lines[0].split(",");
        vm.parse_header = lines[0].split(",");
        lines[0].split(",").forEach(function (key) {
          vm.sortOrders[key] = 1;
        });

        lines.map(function (line, indexLine) {
          if (indexLine < 1) return; // Jump header line

          var obj = {};
          var currentline = line.split(",");

          headers.map(function (header, indexHeader) {
            obj[header] = currentline[indexHeader];
          });

          result.push(obj);
        });

        result.pop(); // remove the last item because undefined values

        return result; // JavaScript object
      },
      loadCSV(e) {
        var vm = this;
        if (window.FileReader) {
          var reader = new FileReader();
          reader.readAsText(e.target.files[0]);
          // Handle errors load
          reader.onload = function (event) {
            var csv = event.target.result;
            vm.parse_csv = vm.csvJSON(csv);
            axios
              .post(`/api/doctor`, {
                data: vm.parse_csv,
                type: e.target.name,
              })
              .then((res) => {
                vm.showImportSuccess();
                //   vm.$router.push({ name: "show-region" });
                setTimeout(() => {
                  // vm.$router.go(0);
                }, 300);
              })
              .catch((err) => {
              });
            this.$router.push({ name: "show-doctor" });
          };
          reader.onerror = function (evt) {
            if (evt.target.error.name == "NotReadableError") {
              alert("Canno't read file !");
            }
          };
        } else {
          alert("FileReader are not supported in this browser.");
        }
        vm.$forceUpdate();
      },
      fun(){
      }, 

      rerender(){
        console.log('here');
        this.key++ ; 
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
      getMandatory(params){
        return params.data.mandatory? 'mandatory' : 'optional' ; 
      },
      filterFields(){
        var component = this;
        this.fields = JSON.parse(
          JSON.stringify(
            this.allFields.filter(function (field) {
              return (
                field.application_id == component.application_id 
              );
            })
          )
        );
      }
    },
};
</script>
