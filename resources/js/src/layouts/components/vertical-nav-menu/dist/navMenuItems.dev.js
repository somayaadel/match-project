"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;
var _default = [{
  url: '/dashboard',
  name: "dashboard",
  icon: "HomeIcon",
  slug: 'dashboard',
  i18n: "Dashboard"
}, {
  url: '/applicationList',
  name: "applicationList",
  icon: "ListIcon",
  slug: 'applicationList',
  i18n: "applications"
}, {
  url: null,
  icon: "ListIcon",
  i18n: "Categories",
  submenu: [{
    url: '/categoryTypeList',
    name: "categoryTypeList",
    slug: 'categoryTypeList',
    i18n: "Category Type List"
  }, {
    url: '/categoryList',
    name: "categoryList",
    slug: 'categoryList',
    i18n: "Category List"
  }]
}, {
  url: null,
  icon: "EditIcon",
  i18n: "Staff",
  submenu: [{
    url: '/staffList',
    name: "staffList",
    slug: 'staffList',
    i18n: "List"
  }, {
    url: '/roles',
    name: "roles",
    slug: 'roles',
    i18n: "Permission"
  }]
}, {
  icon: "UserIcon",
  slug: 'users',
  i18n: "Users",
  submenu: [{
    url: '/companyList',
    name: "companyList",
    slug: 'companyList',
    i18n: "Companies"
  }, {
    url: '/freeUserList',
    name: "freeUserList",
    slug: 'freeUserList',
    i18n: "Free users"
  }, {
    url: '/premiumUserList',
    name: "premiumUserList",
    slug: 'premiumUserList',
    i18n: "premium users"
  }, {
    url: '/addUser',
    name: "addUser",
    slug: 'addUser',
    i18n: "Add user"
  }, {
    url: '/blockedUsers',
    name: "blockedUsers",
    slug: 'blockedUsers',
    i18n: "Blocked users"
  }, {
    url: '/deletedUserList',
    name: "deletedUserList",
    slug: 'deletedUserList',
    i18n: "Deleted users"
  }]
}, {
  url: '/packageList',
  name: "packageList",
  icon: "PackageIcon",
  slug: 'packageList',
  i18n: "Packages"
}, {
  url: '/earningList',
  name: "earningList",
  icon: "PackageIcon",
  slug: 'earningList',
  i18n: "Earning"
}, {
  url: '/applicationSettings',
  name: "applicationSettings",
  icon: "PackageIcon",
  slug: 'applicationSettings',
  i18n: "Application settings"
}, {
  icon: "MailIcon",
  i18n: "Emails",
  submenu: [{
    url: '/emailList',
    name: "emailList",
    slug: 'emailList',
    i18n: "EmailList"
  }, {
    url: '/sendEmail',
    name: "sendEmail",
    icon: "MailIcon",
    slug: 'sendEmail-',
    i18n: "SendEmail"
  }]
}, {
  url: '/sendSMS',
  name: "sendSMS",
  icon: "MailIcon",
  slug: 'sendSMS-',
  i18n: "SendSMS"
}, {
  icon: "MailIcon",
  i18n: "Fields",
  submenu: [{
    url: '/profileFields',
    name: "profileFields",
    icon: "profileFields",
    slug: 'profileFields',
    i18n: "Profile Fields"
  }, {
    url: '/fieldList',
    name: "fieldList",
    icon: "fieldList",
    slug: 'fieldList',
    i18n: "List"
  }, {
    url: '/addField',
    name: "addField",
    icon: "addField",
    slug: 'addField',
    i18n: "Add"
  }]
}, {
  url: null,
  icon: "EditIcon",
  slug: 'configurations',
  i18n: "Configurations",
  submenu: [{
    url: '/countryList',
    name: "countryList",
    slug: 'countryList',
    i18n: "Countries"
  }, {
    url: '/cityList',
    name: "cityList",
    slug: 'cityList',
    i18n: "Cities"
  }, {
    url: '/jobList',
    name: "jobList",
    slug: 'jobList',
    i18n: "Jobs"
  }, {
    url: '/featureList',
    name: "featureList",
    slug: 'featureList',
    i18n: "Feauters"
  }]
}];
exports["default"] = _default;