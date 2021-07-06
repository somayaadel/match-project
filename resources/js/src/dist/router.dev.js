"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _vue = _interopRequireDefault(require("vue"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _authService = _interopRequireDefault(require("@/auth/authService"));

var _app = _interopRequireDefault(require("firebase/app"));

require("firebase/auth");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

function _getRequireWildcardCache() { if (typeof WeakMap !== "function") return null; var cache = new WeakMap(); _getRequireWildcardCache = function _getRequireWildcardCache() { return cache; }; return cache; }

function _interopRequireWildcard(obj) { if (obj && obj.__esModule) { return obj; } if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") { return { "default": obj }; } var cache = _getRequireWildcardCache(); if (cache && cache.has(obj)) { return cache.get(obj); } var newObj = {}; var hasPropertyDescriptor = Object.defineProperty && Object.getOwnPropertyDescriptor; for (var key in obj) { if (Object.prototype.hasOwnProperty.call(obj, key)) { var desc = hasPropertyDescriptor ? Object.getOwnPropertyDescriptor(obj, key) : null; if (desc && (desc.get || desc.set)) { Object.defineProperty(newObj, key, desc); } else { newObj[key] = obj[key]; } } } newObj["default"] = obj; if (cache) { cache.set(obj, newObj); } return newObj; }

_vue["default"].use(_vueRouter["default"]);

var router = new _vueRouter["default"]({
  mode: 'history',
  base: process.env.BASE_URL,
  scrollBehavior: function scrollBehavior() {
    return {
      x: 0,
      y: 0
    };
  },
  routes: [{
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
    path: '',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('./layouts/main/Main.vue'));
      });
    },
    children: [// =============================================================================
    // Theme Routes
    // =============================================================================
    {
      path: '/',
      meta: {
        rule: 'public'
      }
    }, {
      path: '/countryList',
      name: 'countryList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/country/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addCountry',
      name: 'addCountry',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/country/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editCountry/:id',
      name: 'editCountry',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/country/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/cityList',
      name: 'cityList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/city/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addCiy',
      name: 'addCity',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/city/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editCity/:id',
      name: 'editCity',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/city/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/jobList',
      name: 'jobList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/job/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addJob',
      name: 'addJob',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/job/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editJob/:id',
      name: 'editJob',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/job/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/applicationList',
      name: 'applicationList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/application/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addApplication',
      name: 'addApplication',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/application/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editApplication/:id',
      name: 'editApplication',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/application/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/categoryList',
      name: 'categoryList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categories/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addCategory',
      name: 'addCategory',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categories/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editCategory/:id',
      name: 'editCategory',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categories/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/importCateg',
      name: 'importCateg',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categories/import.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editCategoryType/:id',
      name: 'editCategoryType',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categoryType/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/categoryTypeList',
      name: 'categoryTypeList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categoryType/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addCategoryType',
      name: 'addCategoryType',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/categoryType/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/packageList',
      name: 'packageList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/package/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editpackage/:id',
      name: 'editpackage',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/package/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addPackage',
      name: 'addPackage',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/package/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addStaff',
      name: 'addStaff',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/staff/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/companyList',
      name: 'companyList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      },
      props: {
        mode: 'company'
      }
    }, {
      path: '/freeUserList',
      name: 'freeUserList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      },
      props: {
        mode: 'free'
      }
    }, {
      path: '/premiumUserList',
      name: 'premiumUserList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      },
      props: {
        mode: 'premium'
      }
    }, {
      path: '/deletedUserList',
      name: 'deletedUserList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      },
      props: {
        mode: 'deleted'
      }
    }, {
      path: '/blockedUsers',
      name: 'blockedUsers',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      },
      props: {
        mode: 'blocked'
      }
    }, {
      path: '/addUser',
      name: 'addUser',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/showUser/:id',
      name: 'showUser',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/show.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editUser/:id',
      name: 'editUser',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/user/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/staffList',
      name: 'staffList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/staff/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addStaff',
      name: 'addStaff',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/staff/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/roles',
      name: 'roles',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/staff/roles.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/sendSMS',
      name: 'sendSMS',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/send_sms.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/earningList',
      name: 'earningList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/earning/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/applicationSettings',
      name: 'applicationSettings',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/applicationSettings/show.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/emailList',
      name: 'emailList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/email/emailList.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/sendEmail',
      name: 'sendEmail',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/email/sendEmail.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/earning/show/:id',
      name: 'showEarning',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/earning/show.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/contactMessageList',
      name: 'contactMessageList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/contact_message/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/profileFields',
      name: 'profileFields',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/field/profileFields.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/fieldList',
      name: 'fieldList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/field/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addField',
      name: 'addField',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/field/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editField/:id',
      name: 'editField',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/field/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/featureList',
      name: 'featureList',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/feature/list.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/addfeature',
      name: 'addfeature',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/feature/add.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/editfeature/:id',
      name: 'editfeature',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/feature/edit.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/googleAnalytics',
      name: 'googleAnalytics',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/configration/googleAnalytics/show.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/dashboard',
      name: 'dashboard',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/dashboard.vue'));
        });
      },
      meta: {
        rule: 'staffOrAdmin'
      }
    }, {
      path: '/companyDashboard',
      name: 'companyDashboard',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/companyDashboard.vue'));
        });
      },
      meta: {
        rule: 'public'
      }
    }, // =============================================================================
    // Application Routes
    // =============================================================================
    {
      path: '/apps/todo',
      redirect: '/apps/todo/all',
      name: 'todo'
    }, {
      path: '/apps/todo/:filter',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/todo/Todo.vue'));
        });
      },
      meta: {
        rule: 'editor',
        parent: "todo",
        no_scroll: true
      }
    }, {
      path: '/apps/chat',
      name: 'chat',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/chat/Chat.vue'));
        });
      },
      meta: {
        rule: 'editor',
        no_scroll: true
      }
    }, {
      path: '/apps/email',
      redirect: '/apps/email/inbox',
      name: 'email'
    }, {
      path: '/apps/email/:filter',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/email/Email.vue'));
        });
      },
      meta: {
        rule: 'editor',
        parent: 'email',
        no_scroll: true
      }
    }, {
      path: '/apps/calendar/vue-simple-calendar',
      name: 'calendar-simple-calendar',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/calendar/SimpleCalendar.vue'));
        });
      },
      meta: {
        rule: 'editor',
        no_scroll: true
      }
    }, {
      path: '/apps/eCommerce/shop',
      name: 'ecommerce-shop',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/eCommerce/ECommerceShop.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'eCommerce'
        }, {
          title: 'Shop',
          active: true
        }],
        pageTitle: 'Shop',
        rule: 'editor'
      }
    }, {
      path: '/apps/eCommerce/wish-list',
      name: 'ecommerce-wish-list',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/eCommerce/ECommerceWishList.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'eCommerce',
          url: '/apps/eCommerce/shop'
        }, {
          title: 'Wish List',
          active: true
        }],
        pageTitle: 'Wish List',
        rule: 'editor'
      }
    }, {
      path: '/apps/eCommerce/checkout',
      name: 'ecommerce-checkout',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/eCommerce/ECommerceCheckout.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'eCommerce',
          url: '/apps/eCommerce/shop'
        }, {
          title: 'Checkout',
          active: true
        }],
        pageTitle: 'Checkout',
        rule: 'editor'
      }
    },
    /*
      Below route is for demo purpose
      You can use this route in your app
        {
            path: '/apps/eCommerce/item/',
            name: 'ecommerce-item-detail-view',
            redirect: '/apps/eCommerce/shop',
        }
    */
    {
      path: '/apps/eCommerce/item/',
      redirect: '/apps/eCommerce/item/5546604'
    }, {
      path: '/apps/eCommerce/item/:item_id',
      name: 'ecommerce-item-detail-view',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/apps/eCommerce/ECommerceItemDetailView.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'eCommerce'
        }, {
          title: 'Shop',
          url: {
            name: 'ecommerce-shop'
          }
        }, {
          title: 'Item Details',
          active: true
        }],
        parent: "ecommerce-item-detail-view",
        pageTitle: 'Item Details',
        rule: 'editor'
      }
    }, {
      path: '/apps/user/user-list',
      name: 'app-user-list',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/apps/user/user-list/UserList.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'User'
        }, {
          title: 'List',
          active: true
        }],
        pageTitle: 'User List',
        rule: 'editor'
      }
    }, {
      path: '/apps/user/user-view/:userId',
      name: 'app-user-view',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/apps/user/UserView.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'User'
        }, {
          title: 'View',
          active: true
        }],
        pageTitle: 'User View',
        rule: 'editor'
      }
    }, {
      path: '/apps/user/user-edit/:userId',
      name: 'app-user-edit',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/apps/user/user-edit/UserEdit.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'User'
        }, {
          title: 'Edit',
          active: true
        }],
        pageTitle: 'User Edit',
        rule: 'editor'
      }
    }, // =============================================================================
    // UI ELEMENTS
    // =============================================================================
    {
      path: '/ui-elements/data-list/list-view',
      name: 'data-list-list-view',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/ui-elements/data-list/list-view/DataListListView.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Data List'
        }, {
          title: 'List View',
          active: true
        }],
        pageTitle: 'List View',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/data-list/thumb-view',
      name: 'data-list-thumb-view',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/ui-elements/data-list/thumb-view/DataListThumbView.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Data List'
        }, {
          title: 'Thumb View',
          active: true
        }],
        pageTitle: 'Thumb View',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/grid/vuesax',
      name: 'grid-vuesax',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/ui-elements/grid/vuesax/GridVuesax.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Grid'
        }, {
          title: 'Vuesax',
          active: true
        }],
        pageTitle: 'Grid',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/grid/tailwind',
      name: 'grid-tailwind',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/ui-elements/grid/tailwind/GridTailwind.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Grid'
        }, {
          title: 'Tailwind',
          active: true
        }],
        pageTitle: 'Tailwind Grid',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/colors',
      name: 'colors',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/colors/Colors.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Colors',
          active: true
        }],
        pageTitle: 'Colors',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/card/basic',
      name: 'basic-cards',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/card/CardBasic.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Card'
        }, {
          title: 'Basic Cards',
          active: true
        }],
        pageTitle: 'Basic Cards',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/card/statistics',
      name: 'statistics-cards',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/card/CardStatistics.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Card'
        }, {
          title: 'Statistics Cards',
          active: true
        }],
        pageTitle: 'Statistics Card',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/card/analytics',
      name: 'analytics-cards',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/card/CardAnalytics.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Card'
        }, {
          title: 'Analytics Card',
          active: true
        }],
        pageTitle: 'Analytics Card',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/card/card-actions',
      name: 'card-actions',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/card/CardActions.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Card'
        }, {
          title: 'Card Actions',
          active: true
        }],
        pageTitle: 'Card Actions',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/card/card-colors',
      name: 'card-colors',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/card/CardColors.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Card'
        }, {
          title: 'Card Colors',
          active: true
        }],
        pageTitle: 'Card Colors',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/table',
      name: 'table',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/table/Table.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Table',
          active: true
        }],
        pageTitle: 'Table',
        rule: 'editor'
      }
    }, {
      path: '/ui-elements/ag-grid-table',
      name: 'ag-grid-table',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/ui-elements/ag-grid-table/AgGridTable.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'agGrid Table',
          active: true
        }],
        pageTitle: 'agGrid Table',
        rule: 'editor'
      }
    }, // =============================================================================
    // COMPONENT ROUTES
    // =============================================================================
    {
      path: '/components/alert',
      name: 'component-alert',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/alert/Alert.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Alert',
          active: true
        }],
        pageTitle: 'Alert',
        rule: 'editor'
      }
    }, {
      path: '/components/avatar',
      name: 'component-avatar',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/avatar/Avatar.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Avatar',
          active: true
        }],
        pageTitle: 'Avatar',
        rule: 'editor'
      }
    }, {
      path: '/components/breadcrumb',
      name: 'component-breadcrumb',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/breadcrumb/Breadcrumb.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Breadcrumb',
          active: true
        }],
        pageTitle: 'Breadcrumb',
        rule: 'editor'
      }
    }, {
      path: '/components/button',
      name: 'component-button',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/button/Button.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Button',
          active: true
        }],
        pageTitle: 'Button',
        rule: 'editor'
      }
    }, {
      path: '/components/button-group',
      name: 'component-button-group',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/button-group/ButtonGroup.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Button Group',
          active: true
        }],
        pageTitle: 'Button Group',
        rule: 'editor'
      }
    }, {
      path: '/components/chip',
      name: 'component-chip',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/chip/Chip.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Chip',
          active: true
        }],
        pageTitle: 'Chip',
        rule: 'editor'
      }
    }, {
      path: '/components/collapse',
      name: 'component-collapse',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/collapse/Collapse.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Collapse',
          active: true
        }],
        pageTitle: 'Collapse',
        rule: 'editor'
      }
    }, {
      path: '/components/dialogs',
      name: 'component-dialog',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/dialogs/Dialogs.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Dialogs',
          active: true
        }],
        pageTitle: 'Dialogs',
        rule: 'editor'
      }
    }, {
      path: '/components/divider',
      name: 'component-divider',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/divider/Divider.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Divider',
          active: true
        }],
        pageTitle: 'Divider',
        rule: 'editor'
      }
    }, {
      path: '/components/dropdown',
      name: 'component-drop-down',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/dropdown/Dropdown.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Dropdown',
          active: true
        }],
        pageTitle: 'Dropdown',
        rule: 'editor'
      }
    }, {
      path: '/components/list',
      name: 'component-list',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/list/List.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'List',
          active: true
        }],
        pageTitle: 'List',
        rule: 'editor'
      }
    }, {
      path: '/components/loading',
      name: 'component-loading',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/loading/Loading.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Loading',
          active: true
        }],
        pageTitle: 'Loading',
        rule: 'editor'
      }
    }, {
      path: '/components/navbar',
      name: 'component-navbar',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/navbar/Navbar.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Navbar',
          active: true
        }],
        pageTitle: 'Navbar',
        rule: 'editor'
      }
    }, {
      path: '/components/notifications',
      name: 'component-notifications',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/notifications/Notifications.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Notifications',
          active: true
        }],
        pageTitle: 'Notifications',
        rule: 'editor'
      }
    }, {
      path: '/components/pagination',
      name: 'component-pagination',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/pagination/Pagination.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Pagination',
          active: true
        }],
        pageTitle: 'Pagination',
        rule: 'editor'
      }
    }, {
      path: '/components/popup',
      name: 'component-popup',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/popup/Popup.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Popup',
          active: true
        }],
        pageTitle: 'Popup',
        rule: 'editor'
      }
    }, {
      path: '/components/progress',
      name: 'component-progress',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/progress/Progress.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Progress',
          active: true
        }],
        pageTitle: 'Progress',
        rule: 'editor'
      }
    }, {
      path: '/components/sidebar',
      name: 'component-sidebar',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/sidebar/Sidebar.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Sidebar',
          active: true
        }],
        pageTitle: 'Sidebar',
        rule: 'editor'
      }
    }, {
      path: '/components/slider',
      name: 'component-slider',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/slider/Slider.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Slider',
          active: true
        }],
        pageTitle: 'Slider',
        rule: 'editor'
      }
    }, {
      path: '/components/tabs',
      name: 'component-tabs',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/tabs/Tabs.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Tabs',
          active: true
        }],
        pageTitle: 'Tabs',
        rule: 'editor'
      }
    }, {
      path: '/components/tooltip',
      name: 'component-tooltip',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/tooltip/Tooltip.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Tooltip',
          active: true
        }],
        pageTitle: 'Tooltip',
        rule: 'editor'
      }
    }, {
      path: '/components/upload',
      name: 'component-upload',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/vuesax/upload/Upload.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Components'
        }, {
          title: 'Upload',
          active: true
        }],
        pageTitle: 'Upload',
        rule: 'editor'
      }
    }, // =============================================================================
    // FORMS
    // =============================================================================
    // =============================================================================
    // FORM ELEMENTS
    // =============================================================================
    {
      path: '/forms/form-elements/select',
      name: 'form-element-select',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/select/Select.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Select',
          active: true
        }],
        pageTitle: 'Select',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-elements/switch',
      name: 'form-element-switch',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/switch/Switch.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Switch',
          active: true
        }],
        pageTitle: 'Switch',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-elements/checkbox',
      name: 'form-element-checkbox',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/checkbox/Checkbox.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Checkbox',
          active: true
        }],
        pageTitle: 'Checkbox',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-elements/radio',
      name: 'form-element-radio',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/radio/Radio.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Radio',
          active: true
        }],
        pageTitle: 'Radio',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-elements/input',
      name: 'form-element-input',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/input/Input.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Input',
          active: true
        }],
        pageTitle: 'Input',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-elements/number-input',
      name: 'form-element-number-input',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/number-input/NumberInput.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Number Input',
          active: true
        }],
        pageTitle: 'Number Input',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-elements/textarea',
      name: 'form-element-textarea',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('./views/forms/form-elements/textarea/Textarea.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Form Elements'
        }, {
          title: 'Textarea',
          active: true
        }],
        pageTitle: 'Textarea',
        rule: 'editor'
      }
    }, // -------------------------------------------------------------------------------------------------------------------------------------------
    {
      path: '/forms/form-layouts',
      name: 'forms-form-layouts',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/forms/FormLayouts.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Forms'
        }, {
          title: 'Form Layouts',
          active: true
        }],
        pageTitle: 'Form Layouts',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-wizard',
      name: 'extra-component-form-wizard',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/forms/form-wizard/FormWizard.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Form Wizard',
          active: true
        }],
        pageTitle: 'Form Wizard',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-validation',
      name: 'extra-component-form-validation',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/forms/form-validation/FormValidation.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Form Validation',
          active: true
        }],
        pageTitle: 'Form Validation',
        rule: 'editor'
      }
    }, {
      path: '/forms/form-input-group',
      name: 'extra-component-form-input-group',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/forms/form-input-group/FormInputGroup.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Form Input Group',
          active: true
        }],
        pageTitle: 'Form Input Group',
        rule: 'editor'
      }
    }, // =============================================================================
    // Pages Routes
    // =============================================================================
    {
      path: '/pages/profile',
      name: 'page-profile',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Profile.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'Profile',
          active: true
        }],
        pageTitle: 'Profile',
        rule: 'editor'
      }
    }, {
      path: '/pages/user-settings',
      name: 'page-user-settings',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/user-settings/UserSettings.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'User Settings',
          active: true
        }],
        pageTitle: 'Settings',
        rule: 'editor'
      }
    }, {
      path: '/pages/faq',
      name: 'page-faq',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Faq.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'FAQ',
          active: true
        }],
        pageTitle: 'FAQ',
        rule: 'editor'
      }
    }, {
      path: '/pages/knowledge-base',
      name: 'page-knowledge-base',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/KnowledgeBase.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'KnowledgeBase',
          active: true
        }],
        pageTitle: 'KnowledgeBase',
        rule: 'editor'
      }
    }, {
      path: '/pages/knowledge-base/category',
      name: 'page-knowledge-base-category',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/KnowledgeBaseCategory.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'KnowledgeBase',
          url: '/pages/knowledge-base'
        }, {
          title: 'Category',
          active: true
        }],
        parent: 'page-knowledge-base',
        rule: 'editor'
      }
    }, {
      path: '/pages/knowledge-base/category/question',
      name: 'page-knowledge-base-category-question',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/KnowledgeBaseCategoryQuestion.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'KnowledgeBase',
          url: '/pages/knowledge-base'
        }, {
          title: 'Category',
          url: '/pages/knowledge-base/category'
        }, {
          title: 'Question',
          active: true
        }],
        parent: 'page-knowledge-base',
        rule: 'editor'
      }
    }, {
      path: '/pages/search',
      name: 'page-search',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Search.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'Search',
          active: true
        }],
        pageTitle: 'Search',
        rule: 'editor'
      }
    }, {
      path: '/pages/invoice',
      name: 'page-invoice',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Invoice.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Pages'
        }, {
          title: 'Invoice',
          active: true
        }],
        pageTitle: 'Invoice',
        rule: 'editor'
      }
    }, // =============================================================================
    // CHARTS & MAPS
    // =============================================================================
    {
      path: '/charts-and-maps/charts/apex-charts',
      name: 'extra-component-charts-apex-charts',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/charts-and-maps/charts/apex-charts/ApexCharts.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Charts & Maps'
        }, {
          title: 'Apex Charts',
          active: true
        }],
        pageTitle: 'Apex Charts',
        rule: 'editor'
      }
    }, {
      path: '/charts-and-maps/charts/echarts',
      name: 'extra-component-charts-echarts',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/charts-and-maps/charts/echarts/Echarts.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Charts & Maps'
        }, {
          title: 'echarts',
          active: true
        }],
        pageTitle: 'echarts',
        rule: 'editor'
      }
    }, {
      path: '/charts-and-maps/maps/google-map',
      name: 'extra-component-maps-google-map',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/charts-and-maps/maps/google-map/GoogleMap.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Charts & Maps'
        }, {
          title: 'Google Map',
          active: true
        }],
        pageTitle: 'Google Map',
        rule: 'editor'
      }
    }, // =============================================================================
    // EXTENSIONS
    // =============================================================================
    {
      path: '/extensions/select',
      name: 'extra-component-select',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/select/Select.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Select',
          active: true
        }],
        pageTitle: 'Select',
        rule: 'editor'
      }
    }, {
      path: '/extensions/quill-editor',
      name: 'extra-component-quill-editor',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/quill-editor/QuillEditor.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Quill Editor',
          active: true
        }],
        pageTitle: 'Quill Editor',
        rule: 'editor'
      }
    }, {
      path: '/extensions/drag-and-drop',
      name: 'extra-component-drag-and-drop',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/drag-and-drop/DragAndDrop.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Drag & Drop',
          active: true
        }],
        pageTitle: 'Drag & Drop',
        rule: 'editor'
      }
    }, {
      path: '/extensions/datepicker',
      name: 'extra-component-datepicker',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/datepicker/Datepicker.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Datepicker',
          active: true
        }],
        pageTitle: 'Datepicker',
        rule: 'editor'
      }
    }, {
      path: '/extensions/datetime-picker',
      name: 'extra-component-datetime-picker',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/datetime-picker/DatetimePicker.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extra Components'
        }, {
          title: 'Datetime Picker',
          active: true
        }],
        pageTitle: 'Datetime Picker',
        rule: 'editor'
      }
    }, {
      path: '/extensions/access-control',
      name: 'extra-component-access-control',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/access-control/AccessControl.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Access Control',
          active: true
        }],
        pageTitle: 'Access Control',
        rule: 'editor'
      }
    }, {
      path: '/extensions/i18n',
      name: 'extra-component-i18n',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/I18n.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'I18n',
          active: true
        }],
        pageTitle: 'I18n',
        rule: 'editor'
      }
    }, {
      path: '/extensions/carousel',
      name: 'extra-component-carousel',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/carousel/Carousel.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Carousel',
          active: true
        }],
        pageTitle: 'Carousel',
        rule: 'editor'
      }
    }, {
      path: '/extensions/clipboard',
      name: 'extra-component-clipboard',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/clipboard/Clipboard.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Clipboard',
          active: true
        }],
        pageTitle: 'Clipboard',
        rule: 'editor'
      }
    }, {
      path: '/extensions/context-menu',
      name: 'extra-component-context-menu',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/context-menu/ContextMenu.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Context Menu',
          active: true
        }],
        pageTitle: 'Context Menu',
        rule: 'editor'
      }
    }, {
      path: '/extensions/star-ratings',
      name: 'extra-component-star-ratings',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/star-ratings/StarRatings.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Star Ratings',
          active: true
        }],
        pageTitle: 'Star Ratings',
        rule: 'editor'
      }
    }, {
      path: '/extensions/autocomplete',
      name: 'extra-component-autocomplete',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/autocomplete/Autocomplete.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Autocomplete',
          active: true
        }],
        pageTitle: 'Autocomplete',
        rule: 'editor'
      }
    }, {
      path: '/extensions/tree',
      name: 'extra-component-tree',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/tree/Tree.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Tree',
          active: true
        }],
        pageTitle: 'Tree',
        rule: 'editor'
      }
    }, {
      path: '/import-export/import',
      name: 'import-excel',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/import-export/Import.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Import/Export'
        }, {
          title: 'Import',
          active: true
        }],
        pageTitle: 'Import Excel',
        rule: 'editor'
      }
    }, {
      path: '/import-export/export',
      name: 'export-excel',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/import-export/Export.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Import/Export'
        }, {
          title: 'Export',
          active: true
        }],
        pageTitle: 'Export Excel',
        rule: 'editor'
      }
    }, {
      path: '/import-export/export-selected',
      name: 'export-excel-selected',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/components/extra-components/import-export/ExportSelected.vue'));
        });
      },
      meta: {
        breadcrumb: [{
          title: 'Home',
          url: '/'
        }, {
          title: 'Extensions'
        }, {
          title: 'Import/Export'
        }, {
          title: 'Export Selected',
          active: true
        }],
        pageTitle: 'Export Excel',
        rule: 'editor'
      }
    }]
  }, // =============================================================================
  // FULL PAGE LAYOUTS
  // =============================================================================
  {
    path: '',
    component: function component() {
      return Promise.resolve().then(function () {
        return _interopRequireWildcard(require('@/layouts/full-page/FullPage.vue'));
      });
    },
    children: [// =============================================================================
    // PAGES
    // =============================================================================
    {
      path: '/callback',
      name: 'auth-callback',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/Callback.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/login',
      name: 'page-login',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/login/Login.vue'));
        });
      },
      meta: {
        rule: 'public'
      }
    }, {
      path: '/pages/register',
      name: 'page-register',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/register/Register.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/forgot-password',
      name: 'page-forgot-password',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/ForgotPassword.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/reset-password',
      name: 'page-reset-password',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/ResetPassword.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/lock-screen',
      name: 'page-lock-screen',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/LockScreen.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/comingsoon',
      name: 'page-coming-soon',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/ComingSoon.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/error-404',
      name: 'page-error-404',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Error404.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/error-500',
      name: 'page-error-500',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Error500.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/not-authorized',
      name: 'page-not-authorized',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/NotAuthorized.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }, {
      path: '/pages/maintenance',
      name: 'page-maintenance',
      component: function component() {
        return Promise.resolve().then(function () {
          return _interopRequireWildcard(require('@/views/pages/Maintenance.vue'));
        });
      },
      meta: {
        rule: 'editor'
      }
    }]
  }, // Redirect to 404 page, if no match found
  {
    path: '*',
    redirect: '/pages/error-404'
  }]
});
var DEFAULT_TITLE = 'match';
router.afterEach(function (to, from) {
  // Remove initial loading
  var appLoading = document.getElementById('loading-bg');

  if (appLoading) {
    appLoading.style.display = "none";
  }

  _vue["default"].nextTick(function () {
    document.title = to.meta.title || DEFAULT_TITLE;
  });
});
router.beforeEach(function (to, from, next) {
  // to.meta.rule = 'admin';
  var component = to.matched[1].instances;
  var role = localStorage.getItem("userInfo") ? JSON.parse(localStorage.getItem("userInfo")).role.name : "";

  if (to.path == "/pages/login") {
    return next();
  }

  if (!localStorage.getItem("userInfo")) {
    router.push("/pages/login");
    return;
  }

  var userPermissions = JSON.parse(localStorage.getItem("userInfo")).permissions;
  var allPermissions = JSON.parse(localStorage.getItem("allpermission"));
  var n = 0;

  if (role == 'staff') {
    userPermissions.forEach(function (permission) {
      if (to.name == permission.router) {
        n = 1;
      }
    });
    if (n) return next();
    console.log('here');
    console.log(allPermissions);
    n = 1;
    allPermissions.forEach(function (permission) {
      if (to.name == permission.router) {
        n = 0;
      }
    });
    if (!n) return;
    return next();
  } // if (to.meta.rule == 'staff') {
  //     console.log('jjjjj', JSON.parse(localStorage.getItem("allpermission")));
  //     (JSON.parse(localStorage.getItem("userInfo")).permissions).map((permission) => {
  //         if (to.name == permission.router) {
  //             return next();
  //         }
  //     })
  //     return next();
  //     router.push("/pages/notAuth.vue");
  // }


  if (to.path === "/") {
    if (role == "admin") {
      router.push("/dashboard");
      return;
    } else if (role == "company") {
      router.push("/companyDashboard");
      return;
    } else if (role == "staff") {
      router.push("/dashboard");
      return;
    } else {
      router.push("/pages/login");
    }
  }

  return next();
});
var _default = router;
exports["default"] = _default;