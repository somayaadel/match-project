"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _axios = _interopRequireDefault(require("axios"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

// axios
var domain = "";
var accessToken = localStorage.getItem("accessToken") ? localStorage.getItem("accessToken") : ""; // sdfg;

var _default = _axios["default"].create({
  domain: domain,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
    Authorization: "Bearer " + accessToken
  }
});

exports["default"] = _default;