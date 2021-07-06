<template>
  <div id="page-user-view">
    <vs-alert
      color="danger"
      title="User Not Found"
      :active.sync="user_not_found"
    >
    </vs-alert>

    <div id="user-data" v-if="user">
      <vx-card title="Account" class="mb-base">
        <!-- Avatar -->
        <div class="vx-row">
          <!-- Avatar Col -->
          <div class="vx-col" id="avatar-col">
            <div class="img-container mb-4 p-5 m-5">
              <img
                v-if="user.user_data"
                :src="user.user_data.profile_image"
                class="rounded w-full"
              />
            </div>
          </div>

          <!-- Information - Col 1 -->
          <div class="vx-col flex-1 p-5" id="account-info-col-1" v-if="user">
            <table>
              <tr>
                <td class="font-semibold">Name</td>
                <td>{{ user.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Email</td>
                <td>{{ user.email }}</td>
              </tr>
              <tr>
                <td class="font-semibold">User Code</td>
                <td>{{ user.user_code }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <!-- Information - Col 2 -->
          <div class="vx-col flex-1" id="account-info-col-2">
            <table>
              <tr>
                <td class="font-semibold">gender</td>
                <td>{{ this.gender }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Birth Date</td>
                <td>{{ user.name }}</td>
              </tr>
              <tr>
                <td class="font-semibold">Phone</td>
                <td v-if="user.user_data">{{ user.user_data.phone }}</td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 2 -->
          <div class="vx-col flex w-full m-5" id="account-manage-buttons">
            <vs-button
              icon-pack="feather"
              icon="icon-edit"
              class="mr-4"
              :to="{
                name: 'editUser',
                params: { id: $route.params.id },
              }"
              >Edit</vs-button
            >
            <vs-button
              type="border"
              color="danger"
              icon-pack="feather"
              icon="icon-trash"
              @click="confirmDeleteRecord"
              >Delete</vs-button
            >
          </div>
        </div>
      </vx-card>

      <vx-card title="Account" class="mb-base">
        <!-- Avatar -->
        <div class="vx-row">
          <!-- Avatar Col -->

          <!-- Information - Col 1 -->
          <div
            v-if="user.user_data"
            class="vx-col flex-1"
            id="account-info-col-1"
          >
            <table>
              <tr>
                <td class="font-semibold">city</td>
                <td>
                  {{
                    user.user_data.city ? user.user_data.city.name : "no data"
                  }}
                </td>
              </tr>
              <tr>
                <td class="font-semibold">Address</td>
                <td>
                  {{
                    user.user_data.address ? user.user_data.address : "no data"
                  }}
                </td>
              </tr>
              <tr>
                <td class="font-semibold">religion</td>
                <td>
                  {{
                    user.user_data.religion
                      ? user.user_data.religion.name
                      : "no data"
                  }}
                </td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 1 -->

          <!-- Information - Col 2 -->
          <div
            class="vx-col flex-1"
            v-if="user.user_data"
            id="account-info-col-2"
          >
            <table>
              <tr>
                <td class="font-semibold">Job</td>
                <td>
                  {{ user.user_data.job ? user.user_data.job.name : "no data" }}
                </td>
              </tr>
              <tr>
                <td class="font-semibold">package</td>
                <td>
                  {{
                    user.user_data.package
                      ? user.user_data.package.name
                      : "no data"
                  }}
                </td>
              </tr>
            </table>
          </div>
          <!-- /Information - Col 2 -->
        </div>
      </vx-card>
      <div class="vx-row">
        <div class="vx-col md:w-1/2 sm-:w-full">
          <vx-card title="Photos" class="mb-base">
            <div class="vx-row" v-if="photos.length > 0">
              <div
                class="vx-col md:w-1/3 sm:w-full d-flex justify-content-center"
                v-for="(item, index) in photos"
                :key="index"
              >
                <vx-card>
                  <img
                    :src="item.path"
                    alt=""
                    style="width: 150px; height: 150px"
                    class="w-full"
                  />
                </vx-card>
              </div>
            </div>
            <div v-if="photos.length == 0"><h5>No Data</h5></div>
          </vx-card>
        </div>
        <div class="vx-col md:w-1/2 sm-:w-full">
          <vx-card title="Videos" class="mb-base">
            <div class="vx-row" v-if="videoes.length > 0">
              <div
                class="vx-col md:w-1/2 sm:w-full"
                v-for="(item, index) in videoes"
                :key="index"
              >
                <vx-card>
                  <video class="w-full p-0 m-0" controls>
                    <source :src="item.path" type="video/mp4" />
                  </video>
                </vx-card>
              </div>
            </div>
            <div v-if="videoes.length == 0"><h5>No Data</h5></div>
          </vx-card>
        </div>
      </div>
      <div class="vx-row">
        <div class="vx-col md:w-1/2 sm-:w-full">
          <vx-card title="interests" class="mb-base">
            <div class="vx-row" v-if="interests.length > 0">
              <div
                class="vx-col md:w-1/4 sm:w-1/2 d-flex justify-content-center"
                v-for="(item, index) in interests"
                :key="index"
              >
                <vx-card>
                  <h5>{{ item.name }}</h5>
                </vx-card>
              </div>
            </div>
            <div v-if="interests.length == 0"><h5>No Data</h5></div>
          </vx-card>
        </div>
        <div class="vx-col md:w-1/2 sm-:w-full">
          <vx-card title="actors matching" class="mb-base">
            <div class="vx-row" v-if="actors.length > 0">
              <div
                class="vx-col md:w-1/4 sm:w-1/2 d-flex justify-content-center"
                v-for="(item, index) in actors"
                :key="index"
              >
                <vx-card>
                  <img
                    :src="item.image"
                    style="width: 150px; height: 150px"
                    class="w-full"
                  />
                </vx-card>
              </div>
            </div>
            <div v-if="actors.length == 0"><h5>No Data</h5></div>
          </vx-card>
        </div>
      </div>
      <!-- Permissions -->
    </div>
  </div>
</template>

<script>
import moduleUserManagement from "@/store/user-management/moduleUserManagement.js";
import axios from "../../axios";
export default {
  data() {
    return {
      user: [],
      media: [],
      user_not_found: false,
      videoes: [],
      photos: [],
      userId: this.$route.params.id,
      gender: "",
      categ: [],

      interests: [],
      actors: [],
    };
  },
  created() {
    console.log("------------------");
    this.getMedia("photo");
    this.getMedia("video");
    this.getuser();
  },
  computed: {},
  methods: {
    getuser() {
      axios
        .get("/api/user/" + this.userId)
        .then((res) => {
          this.user = res.data.data;

          if (this.user) {
            if (this.user.user_data.gender == 0) {
              this.gender = "male";
            } else {
              this.gender = "female";
            }
          }
          this.categ = this.user.categories;
          this.categ.map((categ) => {
            if (categ.category_type_id == 1) {
              this.interests.push(categ);
            } else if (categ.category_type_id == 2) {
              this.actors.push(categ);
            }
          });
          console.log("user ", this.actors);
        })
        .catch((err) => {});
    },
    getMedia(type) {
      axios
        .get("/api/upload/" + this.userId + "/" + type)
        .then((res) => {
          if (type == "photo") {
            this.photos = res.data.data;
          } else if (type == "video") {
            this.videoes = res.data.data;
          }
        })
        .catch((err) => {});
    },
    confirmDeleteRecord() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: `Confirm Delete`,
        text: `You are about to delete `,
        accept: this.deleteRecord,
        acceptText: "Delete",
      });
    },
    deleteRecord() {
      this.showDeleteSuccess();
    },
    showDeleteSuccess() {
      this.$vs.notify({
        color: "success",
        title: "User Deleted",
        text: "The selected user was successfully deleted",
      });
    },
  },
};
</script>

<style lang="scss">
#avatar-col {
  width: 10rem;
}
#page-user-view {
  table {
    td {
      vertical-align: top;
      min-width: 140px;
      padding-bottom: 0.8rem;
      word-break: break-all;
    }
    &:not(.permissions-table) {
      td {
        @media screen and (max-width: 370px) {
          display: block;
        }
      }
    }
  }
}

@media screen and (min-width: 1201px) and (max-width: 1211px),
  only screen and (min-width: 636px) and (max-width: 991px) {
  #account-info-col-1 {
    width: calc(100% - 12rem) !important;
  }
}
</style>
