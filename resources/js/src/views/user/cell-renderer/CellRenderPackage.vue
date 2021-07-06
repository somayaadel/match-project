<template>
  <div class="flex items-center">
    <vs-button
      icon-pack="feather"
      icon-no-border
      @click="showPackage()"
      color="primary"
      type="border"
      >package</vs-button
    >

    <vs-popup
      classContent="popup-example"
      title="deatails"
      :active.sync="packagePopup"
    >
      <div class="vx-row" v-if="package">
        <div class="vx-col w-1/2">
          <vx-card title="current package" class="mb-base">
            <table>
              <tr>
                <td class="font-semibold">user package :</td>
                <td v-if="package">{{ package.name }}</td>
                <td v-if="!package">default</td>
              </tr>
              <tr>
                <td class="font-semibold">package price :</td>
                <td v-if="package">{{ package.price }}</td>
                <td v-if="!package">0$</td>
              </tr>
              <tr>
                <td class="font-semibold">payment type :</td>
                <td v-if="package">{{ package.pymentType }}</td>
                <td v-if="!package">none</td>
              </tr>
            </table>
          </vx-card>
        </div>

        <div class="vx-col w-1/2">
          <vx-card title="features" class="mb-base">
            <table v-if="package">
              <tr>
                <th>Features</th>
                <th>Limitation</th>
              </tr>
              <tr :key="index" v-for="(item, index) in package.features">
                <td class="font-semibold">{{ item.name }}</td>
                <td>: {{ item.pivot.limitation }}</td>
              </tr>
            </table>

            <div v-if="!package"><h6>no features</h6></div>
          </vx-card>
        </div>
      </div>
      <div v-if="!package">
        <vs-card><h3>No Data</h3></vs-card>
      </div>

      <div class="vx-row">
        <div class="vx-col sm:w-2/3 w-full ml-auto">
          <vs-button class="mr-3 mb-2" @click="updatePackage()"
            >update</vs-button
          >
        </div>
      </div>
    </vs-popup>

    <vs-popup
      classContent="popup-example"
      title="deatails"
      :active.sync="updatePackagePopUp"
    >
      <div class="container">
        <div class="vx-col w-full py-5">
          <vs-select
            class="selectExample w-full"
            label="package"
            name="service_id"
            v-validate="'required'"
            v-model="package_id"
            label-placeholder=" package"
          >
            <vs-select-item
              :key="index"
              :value="item.id"
              :text="item.name"
              v-for="(item, index) in packages"
            />
          </vs-select>
        </div>
      </div>

      <div class="vx-row">
        <div class="vx-col sm:w-2/3 w-full ml-auto">
          <vs-button class="mr-3 mb-2" @click="submitPackage()"
            >submit</vs-button
          >
        </div>
      </div>
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
      packagePopup: false,
      updatePackagePopUp: false,
      package: {},
      packages: [],
      package_id: "",
    };
  },
  created() {
    axios.get("api/package").then((res) => {
      this.packages = res.data.data.filter((package2) => {
        return package2.role_id == this.params.data.role_id;
      });
    });
  },
  components: {},
  methods: {
    showPackage() {
      console.log("showPackage");
      console.log(this.package);
      this.package = this.params.data.user_data.package;
      if (this.package) this.package_id = this.package.id;
      this.packagePopup = true;
    },
    updatePackage() {
      this.packagePopup = false;
      this.updatePackagePopUp = true;
    },
    submitPackage() {
      axios
        .post("api/user/" + this.params.data.id + "/update-package", {
          package_id: this.package_id,
        })
        .then((res) => {
          this.showSuccess("updated successfuly");
        })
        .catch((err) => {
          var errors = err.response.data.errors;
          Object.keys(errors).forEach((key) => {
            this.showError(errors[key]);
          });
        });
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
        title: " successfuly",
        text: msg,
      });
    },
    showError(msg) {
      this.$vs.notify({
        color: "danger",
        title: "Error",
        text: msg,
        position: "top-center",
      });
    },
  },
};
</script>
<style>
.field {
  margin: 500px !important;
}
</style>
