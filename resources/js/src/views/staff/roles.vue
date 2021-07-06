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
          <h3>add staff permissions</h3>
        </div>
        <div class="vx-row">
          <vs-select
            class="selectExample w-1/2 p-5"
            label="choose staff name"
            v-validate="'required'"
            v-model="user_id"
            @input="getUserPermission()"
          >
            <vs-select-item
              :key="index"
              :value="item.id"
              :text="item.name"
              v-for="(item, index) in allStaff"
            />
          </vs-select>
        </div>
        <vx-card class="w-1/2 ml-outo">
          <div class="py-3" v-for="(item, index) in allPermission" :key="index">
            <vs-checkbox :value="item.id" v-model="user_permission[index]">{{
              item.name
            }}</vs-checkbox>
          </div>
          <div class="row">
            <vs-button @click="submitData()">submit</vs-button>
          </div>
        </vx-card>
      </vx-card>
    </div>
  </div>
</template>


<script>
import axios from "../../axios.js";

export default {
  data() {
    return {
      user_id: "",
      allPermission: [],
      staffData: {
        user: "",
      },
      permission_check: [],
      user_permission: [],
      allStaff: [],
      searchQuery: "",
      permissions: [],
    };
  },
  watch: {},
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  mounted() {
    this.getAllStaff();
    this.getPermission();
  },
  methods: {
    getAllStaff() {
      axios
        .get("/api/allStaff")
        .then((res) => {
          this.allStaff = res.data.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPermission() {
      axios
        .get("/api/permission")
        .then((res) => {
          this.allPermission = res.data.data;
          localStorage.setItem(
            "allpermission",
            JSON.stringify(this.allPermission)
          );

          console.log("permistions : ", this.allPermission);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getUserPermission() {
      axios
        .get("/api/userPermission/show/" + this.user_id)
        .then((res) => {
          this.user_permission = res.data.data;
          console.log("permission", this.user_permission);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    submitData() {
      if (this.user_id) {
        this.user_permission.forEach((permission_id, index) => {
          if (permission_id) {
            this.permissions.push({
              user_id: this.user_id,
              permission_id: this.allPermission[index].id,
            });
          }
        });

        axios
          .post("/api/userPermission/" + this.user_id, this.permissions)
          .then((res) => {
            this.showSuccess();
          })
          .catch((err) => {
            console.log(err);
          });
      } else {
        this.showError();
      }
    },

    showSuccess() {
      this.$vs.notify({
        color: "success",
        title: "permission is added successfully",
        text: "permission is added successfully",
      });
    },
    showError() {
      this.$vs.notify({
        color: "danger",
        title: "must choose user",
        text: "must choose user first",
      });
    },
  },
};
</script>
