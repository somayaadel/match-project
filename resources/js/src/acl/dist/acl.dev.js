"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vue = _interopRequireDefault(require("vue"));

var _vueAcl = require("vue-acl");

var _router = _interopRequireDefault(require("@/router"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

_vue["default"].use(_vueAcl.AclInstaller);

var initialRole = "admin";
var userInfo = JSON.parse(localStorage.getItem("userInfo"));
if (userInfo && userInfo.userRole) initialRole = userInfo.userRole;

var _default = new _vueAcl.AclCreate({
  initial: initialRole,
  notfound: "/pages/not-authorized",
  router: _router["default"],
  acceptLocalRules: true,
  globalRules: {
    admin: new _vueAcl.AclRule("admin").generate(),
    company: new _vueAcl.AclRule("company").generate(),
    staff: new _vueAcl.AclRule("staff").or('admin').generate(),
    "public": new _vueAcl.AclRule("public").or("admin").or("company").generate()
  }
});

exports["default"] = _default;