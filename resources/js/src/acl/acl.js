import Vue from "vue"
import {
    AclInstaller,
    AclCreate,
    AclRule
} from "vue-acl"
import router from "@/router"

Vue.use(AclInstaller)

let initialRole = "admin"

let userInfo = JSON.parse(localStorage.getItem("userInfo"))
if (userInfo && userInfo.userRole) initialRole = userInfo.userRole

export default new AclCreate({
    initial: initialRole,
    notfound: "/pages/not-authorized",
    router,
    acceptLocalRules: true,
    globalRules: {
        admin: new AclRule("admin").generate(),
        company: new AclRule("company").generate(),
        staffOrAdmin: new AclRule("staff").or('admin').generate(),
        public: new AclRule("public").or("admin").or("company").generate(),
    }
})
