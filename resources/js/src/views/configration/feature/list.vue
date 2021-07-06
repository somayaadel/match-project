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
                            name="Feature"
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
            <div class="vs-row flex">
                <div class="w-1/4 mb-6">
                    <div class="search-page__search-bar flex items-center">
                        <h2 class="text-greyy">Feature</h2>
                    </div>
                </div>
            </div>
        </div>

        <vx-card>
            <div class="flex">
                <div class="w-full float-right">
                    <h3>Feature</h3>
                </div>

                <div class>
                    <vs-button
                        icon-pack="feather"
                        icon="icon-edit"
                        class="mr-4"
                        color="primary"
                        :to="{ name: 'addfeature' }"
                        >+ Add Feature</vs-button
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
                                    currentPage * paginationPageSize -
                                        (paginationPageSize - 1)
                                }}
                                -
                                {{
                                    features.length -
                                        currentPage * paginationPageSize >
                                    0
                                        ? currentPage * paginationPageSize
                                        : features.length
                                }}
                                of {{ features.length }}
                            </span>
                            <feather-icon
                                icon="ChevronDownIcon"
                                svgClasses="h-4 w-4"
                            />
                        </div>
                        <!-- <vs-button class="btn-drop" type="line" color="primary" icon-pack="feather" icon="icon-chevron-down"></vs-button> -->
                        <vs-dropdown-menu>
                            <vs-dropdown-item
                                @click="gridApi.paginationSetPageSize(20)"
                            >
                                <span>20</span>
                            </vs-dropdown-item>
                            <vs-dropdown-item
                                @click="gridApi.paginationSetPageSize(50)"
                            >
                                <span>50</span>
                            </vs-dropdown-item>
                            <vs-dropdown-item
                                @click="gridApi.paginationSetPageSize(100)"
                            >
                                <span>100</span>
                            </vs-dropdown-item>
                            <vs-dropdown-item
                                @click="gridApi.paginationSetPageSize(150)"
                            >
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
            :rowData="features"
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
import axios from "../../../axios.js";
import CellRendererAdd from "./cell-renderer/CellRendererAdd.vue";
import { AgGridVue } from "ag-grid-vue";
import "@sass/vuexy/extraComponents/agGridStyleOverride.scss";
import CellRendererActions from "./cell-renderer/CellRendererActions.vue";

export default {
    components: {
        AgGridVue,
        CellRendererActions
    },
    data() {
        return {
            features: [],
            parse_csv: [],
            sortOrders: {},
            sortKey: "",
            searchQuery: [],
            gridOptions: {},
            maxPageNumbers: 7,
            gridApi: null,

            defaultColDef: {
                sortable: false,
                editable: false,
                resizable: false,
                suppressMenu: false
            },
            columnDefs: [
                {
                    headerName: "Name",
                    field: "name",
                    width: 225,
                    filter: true
                },
                {
                    headerName: "Type",
                    field: "service.name",
                    filter: true,
                    width: 225
                },
                {
                    headerName: "Actions",
                    field: "transactions",
                    cellRendererFramework: "CellRendererActions",
                    width: 150
                }
            ],
            components: {
                AgGridVue,
                CellRendererActions
            }
        };
    },

    mounted() {
        this.getFeature();
    },
    methods: {
        getFeature() {
            axios
                .get("/api/feature")
                .then(res => {
                    this.features = res.data.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>
