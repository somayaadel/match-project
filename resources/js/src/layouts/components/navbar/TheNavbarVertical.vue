<template>
  <div class="containerA relative">
    <div class="vx-navbar-wrapper" :class="classObj">
      <vs-navbar
        class="vx-navbar navbar-custom navbar-skelton"
        :color="navbarColorLocal"
        :class="textColor"
      >

        <img 
            :src="logo? logo: 'https://idraksy.net/wp-content/uploads/2020/04/placeholder.png'"
            style="width: 8% ;"
            class="pl-5"
        />
        <div class="container" >
            <div class="vx-col w-full py-5">
              <vs-select
                @input="applicationChanged"
                class="selectExample w-full"
                label="application"
                name="service_id"
                v-validate="'required'"
                v-model="applicationId"
                label-placeholder=" application"
              >
                <vs-select-item
                  :key="index"
                  :value="item.id"
                  :text="item.name"
                  v-for="(item, index) in applications"
                />
              </vs-select>
            </div>
        </div>
        <!-- SM - OPEN SIDEBAR BUTTON -->
        <feather-icon
          class="sm:inline-flex xl:hidden cursor-pointer p-2"
          icon="MenuIcon"
          @click.stop="showSidebar"
        />
        <vs-spacer />
        <profile-drop-down />
      </vs-navbar>
    </div>
  </div>
</template>

<script>
import Bookmarks from "./components/Bookmarks.vue";
import I18n from "./components/I18n.vue";
import SearchBar from "./components/SearchBar.vue";
import CartDropDown from "./components/CartDropDown.vue";
import NotificationDropDown from "./components/NotificationDropDown.vue";
import ProfileDropDown from "./components/ProfileDropDown.vue";
import axios from "../../../axios.js";
export default {
    name: "the-navbar-vertical",
    props: {
        navbarColor: {
            type: String,
            default: "#fff"
        }
    },
    data() {
        return {
            applicationId: "",
            applications: [] , 
            logo : "" , 
        };
    },
    components: {
        Bookmarks,
        I18n,
        SearchBar,
        CartDropDown,
        NotificationDropDown,
        ProfileDropDown
    },
    created() {
        this.getApplications();
    },
    computed: {
        application_id: function() {
            return this.$store.state.application_id;
        },
        navbarColorLocal() {
            return this.$store.state.theme === "dark" &&
                this.navbarColor === "#fff"
                ? "#10163a"
                : this.navbarColor;
        },
        verticalNavMenuWidth() {
            return this.$store.state.verticalNavMenuWidth;
        },
        textColor() {
            return {
                "text-white":
                    (this.navbarColor != "#10163a" &&
                        this.$store.state.theme === "dark") ||
                    (this.navbarColor != "#fff" &&
                        this.$store.state.theme !== "dark")
            };
        },
        windowWidth() {
            return this.$store.state.windowWidth;
        },
        // NAVBAR STYLE
        classObj() {
            if (this.verticalNavMenuWidth == "default") return "navbar-default";
            else if (this.verticalNavMenuWidth == "reduced")
                return "navbar-reduced";
            else if (this.verticalNavMenuWidth) return "navbar-full";
        }
    },
    methods: {
        showSidebar() {
            this.$store.commit("TOGGLE_IS_VERTICAL_NAV_MENU_ACTIVE", true);
        },
        applicationChanged() {
            
            this.updateLogo(); 
            this.$store.dispatch("changeApplicationId", this.applicationId);
            this.$root.$children[0]._data.key++ ; 

        },
        updateLogo(){
            var component = this ; 
            this.applications.forEach(application => {
                if(application.id == component.applicationId){
                    console.log('heeeelp');
                    component.logo = application.logo ; 
                }
            });
        },
        getApplications() {
            axios
                .get("/api/application/")
                .then(res => {
                    this.applications = res.data.data;
                    this.applicationId = this.application_id;
                    this.updateLogo();  

                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="stylus" scoped>
.containerA{
  padding-top :100px ;
}
</style>
