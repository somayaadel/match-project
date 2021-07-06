<!-- =========================================================================================
    File Name: tableFilterSorter.vue
    Description: Add filter and sorting functionality to table
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div v-if="fields" >
    <div bg-white>
      <div class="vs-row flex">
        <div class="w-1/4 mb-6">
          <div class="search-page__search-bar flex items-center">
            <vs-input
              name="Roles"
              icon-no-border
              placeholder="Search"
              class="w-full input-rounded-full p-5"
              icon="icon-search"
              icon-pack="feather"
            />
          </div>
        </div>
      </div>
      <vx-card>
        <div class="vx-row p-5">
          <h3>Edit Application Profile Fields</h3>
        </div>
        
        <vx-card>
          <vs-table pagination :max-items="6" search :data="fields">
            <template slot="thead">
                <vs-th sort-key="name" class="tableHead">required</vs-th>
                <vs-th sort-key="name" class="tableHead">name</vs-th>
                <vs-th sort-key="name" class="tableHead">arabic name</vs-th>
                <vs-th sort-key="name" class="tableHead">mandatory</vs-th>


            </template>

            <template>
                <vs-tr
                    
                    v-for="(item,index) in fields " :key="index"
                    class="vs-align-center"
                >
                    <vs-td>
                        <vx-tooltip color="primary" text="select the field to display it in user profile field">
                            <vs-checkbox v-model="fields[index].required" ></vs-checkbox>
                        </vx-tooltip>
                    </vs-td>
                    <vs-td>
                        {{ fields[index].name }}
                    </vs-td>
                    <vs-td>
                        {{ fields[index].name_ar }}
                    </vs-td>
                    <vs-td>
                        <div class="vx-col">
                          <vs-switch v-model="fields[index].mandatory">
                            <span slot="on">mandatory</span>
                            <span slot="off">optional</span>
                          </vs-switch>
                        </div>
                    </vs-td>

                </vs-tr>
            </template>
          </vs-table>
          
            
        
        </vx-card>
      </vx-card>

      <div class="vx-row">
        <div class="vx-col w-full mt-5">
          <vs-button
            class="mr-3 mb-2"
            color="primary"
            @click="submitData()"
            >Save</vs-button
          >
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "../../axios.js";
 
export default {
  data() {
    return {
      fields: [],
      staffData: {
        user: "",
      },
      allStaff: [],
      searchQuery: "",
    };
  },
  watch: {
     application_id : function(val){
          this.filterFields() ; 
      }
      ,
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  mounted() {
    this.getFields();
  },
  methods: {
    getFields(){
      axios
        .get("/api/field")
        .then((res) => {
          this.fields = res.data.data;
          this.allFields = res.data.data ; 
            this.filterFields() ; 
        })
        .catch((err) => {
          console.log(err);
        });
    },
 
    showDeleteSuccess() {
      this.$vs.notify({
        color: "success",
        title: "User Deleted",
        text: "The selected user was successfully deleted",
      });

    },
    submitData(){
      axios.put('/api/field' , this.fields).then(res=>{
        this.showSuccess('updated successfully'); 
      })
      .catch(err=>{
        console.log(err);
      })
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: 'success',
        title: 'User Deleted',
        text: msg
      })
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
