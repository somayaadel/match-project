
<template>
  <div class="container">
    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>Role</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-select
          name="gender"
          v-validate="'required'"
          v-model="userData.role_id"
          label-placeholder=" role"
          @input="roleChanged()"
        >
          <vs-select-item
            :key="index"
            :value="item.id"
            :text="item.name"
            v-for="(item, index) in roles"
          />
        </vs-select>
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>name</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input class="w-full" v-model="userData.name" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>name in arabic</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input class="w-full" v-model="userData.name_ar" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>email</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input type="email" class="w-full" v-model="userData.email" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>phone</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input type="number" class="w-full" v-model="userData.phone" />
      </div>
    </div>

    <div class="vx-row mb-6" v-if="userData.role_id != 2">
      <div class="vx-col sm:w-1/3 w-full">
        <span>birth date</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <datepicker
          class="date-picker vx-col w-full"
          type="date"
          name="voucherActivationDate"
          v-model="userData.birth_date"
        ></datepicker>
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>address</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input type="text" class="w-full" v-model="userData.address" />
      </div>
    </div>

    <div class="vx-row mb-6" v-if="userData.role_id != 2">
      <div class="vx-col sm:w-1/3 w-full">
        <span>Gender</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-select
          name="gender"
          v-validate="'required'"
          v-model="userData.gender"
          label-placeholder=" gender"
        >
          <vs-select-item value="0" text="male" />

          <vs-select-item value="1" text="female" />
        </vs-select>
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-1/2">
        <span>package</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-select
          name="service_id"
          v-validate="'required'"
          v-model="userData.package_id"
          label-placeholder=" package"
          @input="packageChanged(item)"
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

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-1/2">
        <span>Interests</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-select
          multiple
          v-validate="'required'"
          v-model="interestsData"
          label-placeholder=" interests"
        >
          <vs-select-item
            :key="index"
            :value="item.id"
            :text="item.name"
            v-for="(item, index) in interests"
          />
        </vs-select>
      </div>
    </div>
    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-1/2">
        <span>Actors matching</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-select
          multiple
          v-validate="'required'"
          v-model="actorsData"
          label-placeholder=" actors"
        >
          <vs-select-item
            :key="index"
            :value="item.id"
            :text="item.name"
            v-for="(item, index) in actors"
          />
        </vs-select>
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-1/2">
        <span>package start date</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <datepicker
          class="date-picker vx-col w-full"
          type="date"
          name="voucherActivationDate"
          v-model="userData.package_start_date"
        ></datepicker>
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>password</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input class="w-full" type="password" v-model="userData.password" />
      </div>
    </div>

    <div class="vx-row mb-6">
      <div class="vx-col sm:w-1/3 w-full">
        <span>password confirmation</span>
      </div>
      <div class="vx-col sm:w-2/3 w-full">
        <vs-input
          class="w-full"
          type="password"
          v-model="userData.password_confirmation"
        />
      </div>
    </div>

    <div class="vx-row mb-6" v-for="(item, index) in fields" :key="index">
      <div class="vx-col sm:w-1/3 w-full">
        <span>{{ item.name }}</span>
      </div>
      <div
        class="vx-col sm:w-2/3 w-full"
        v-if="item.type == 'string' || item.type == 'number'"
      >
        <vs-input
          :type="item.type"
          class="w-full"
          v-model="userData.fields[item.id]"
        />
      </div>
      <div
        class="vx-col sm:w-2/3 w-full"
        v-if="item.type == 'select' || item.type == 'multi-select'"
      >
        <vs-select
          v-validate="'required'"
          v-model="userData.fields[item.id]"
          :multiple="item.type == 'multi-select' ? true : false"
        >
          <vs-select-item
            :key="index2"
            :value="item2.name"
            :text="item2.name"
            v-for="(item2, index2) in item.items"
          />
        </vs-select>
      </div>
    </div>

    <vs-upload
      limit="1"
      automatic
      text="Add profile picture"
      id="ufile"
      ref="ufile"
      fileName="CODE"
      action
    />

    <div class="vx-row">
      <div class="vx-col sm:w-2/3 w-full ml-auto">
        <vs-button class="mr-3 mb-2" @click="submitData()">save</vs-button>
        <vs-button color="warning" type="border" class="mb-2">Reset</vs-button>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "../../axios.js";
import Datepicker from "vuejs-datepicker";
export default {
  data() {
    return {
      interests: [],
      actors: [],
      test: [],
      applications: [],
      packages: [],
      categories: [],
      roles: [],
      interestsData: [],
      actorsData: [],
      userData: {
        fields: [],
        categories: [],
        package_start_date: new Date(),
      },
      profilePicture: "",
      fields: [],
      allFields: [],
    };
  },
  components: {
    Datepicker,
  },
  created() {
    this.getCreateData();
    this.userData.fields = [];
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  watch: {
    "userData.role_id": function (newVal, oldVal) {
      this.filterFields();
    },
    application_id: function (newVal, oldVal) {
      this.filterFields();
      this.getCreateData();
    },
  },
  methods: {
    getCreateData() {
      this.userData.application_id = this.application_id;

      axios
        .get("/api/user/create/?application_id=" + this.application_id)
        .then((res) => {
          this.applications = res.data.applications;
          this.packages = res.data.packages;
          this.fields = res.data.fields;
          this.allFields = res.data.fields;
          this.categories = res.data.categories;
          this.categories.map((categ) => {
            if (categ.category_type_id == 1) {
              this.interests.push(categ);
            } else if (categ.category_type_id == 2) {
              this.actors.push(categ);
            }
          });
          console.log("categories : ", this.categories);
          this.filterFields();
          this.roles = res.data.roles;
          this.allPackages = JSON.parse(JSON.stringify(res.data.packages));
        });
    },
    submitData() {
      this.profilePicture = this.$refs.ufile.filesx[0];
      if (!this.$refs.ufile.filesx[0]) {
        this.sendUserPostRequest();
        return;
      }
      var component = this;
      var reader = new FileReader();
      reader.readAsDataURL(this.profilePicture);
      reader.onload = function () {
        component.profilePicture = reader.result;
        component.userData.profileImage = reader.result;
        component.sendUserPostRequest();
      };
    },
    filterFields() {
      var component = this;
      this.fields = JSON.parse(
        JSON.stringify(
          this.allFields.filter(function (field) {
            return (
              field.required &&
              field.application_id == component.application_id &&
              field.role_id == component.userData.role_id
            );
          })
        )
      );
      console.log("here");

      this.fields = this.fields.map(function (field, index) {
        if (field.type == "multi-select" || field.type == "select") {
          component.userData.fields[field.id] = [];
        } else {
          component.userData.fields[field.id] = "";
        }
        return field;
      });
      console.log("fields : ", this.fields);
      console.log("userData : ", this.userData);
    },
    sendUserPostRequest() {
      this.userData.application_id = this.application_id;

      axios
        .post("/api/user", this.userData)
        .then((res) => {
          this.showSuccess("user has been created successfuly");
          this.storeCategory(res.data.data.id, 1, this.interestsData);
          this.storeCategory(res.data.data.id, 2, this.actorsData);
        })
        .catch((err) => {
          var errors = err.response.data.errors;
          Object.keys(errors).forEach((key) => {
            this.showError(errors[key]);
          });
        });
    },
    storeCategory(userId, typeId, categories_ids) {
      axios
        .post("/api/user/" + userId + "/update-category", {
          type_id: typeId,
          categories_ids: categories_ids,
          application_id: this.application_id,
        })
        .then((res) => {
          this.showSuccess("user category has been created successfuly");
        })
        .catch((err) => {
          this.showError(errors[key]);
        });
    },
    roleChanged() {
      var component = this;
      this.packages = this.allPackages.filter(function (package2) {
        return (
          package2.role_id == component.userData.role_id &&
          package2.application_id == component.application_id
        );
      });
    },
    showSuccess(msg) {
      this.$vs.notify({
        color: "success",
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
    packageChanged(package2) {
      this.userData.all_packages.forEach((p) => {
        if (p.id == package2.id) {
          this.userData.package_start_date = p.pivot.start_date;
          console.log("----------");
        }
      });
    },
  },
};
</script>
