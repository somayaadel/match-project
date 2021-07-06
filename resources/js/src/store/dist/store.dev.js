"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vue = _interopRequireDefault(require("vue"));

var _vuex = _interopRequireDefault(require("vuex"));

var _state = _interopRequireDefault(require("./state"));

var _getters = _interopRequireDefault(require("./getters"));

var _mutations = _interopRequireDefault(require("./mutations"));

var _actions = _interopRequireDefault(require("./actions"));

var _moduleAuth = _interopRequireDefault(require("./auth/moduleAuth.js"));

var _moduleECommerce = _interopRequireDefault(require("./eCommerce/moduleECommerce.js"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

/*=========================================================================================
  File Name: store.js
  Description: Vuex store
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
_vue["default"].use(_vuex["default"]); // import moduleTodo from './todo/moduleTodo.js'
// import moduleCalendar from './calendar/moduleCalendar.js'
// import moduleChat from './chat/moduleChat.js'
// import moduleEmail from './email/moduleEmail.js'


// import moduleApplication from './application/moduleApplication.js'
var _default = new _vuex["default"].Store({
  getters: _getters["default"],
  mutations: _mutations["default"],
  state: _state["default"],
  actions: _actions["default"],
  modules: {
    // todo: moduleTodo,
    // calendar: moduleCalendar,
    // chat: moduleChat,
    // email: moduleEmail,
    auth: _moduleAuth["default"],
    eCommerce: _moduleECommerce["default"] // application : moduleApplication  ,

  },
  strict: process.env.NODE_ENV !== 'production'
});

exports["default"] = _default;