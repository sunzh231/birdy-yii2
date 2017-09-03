// config
function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i=0; i<ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1);
    if (c.indexOf(name) != -1) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

var app = angular.module('app').config(['$controllerProvider', '$compileProvider', '$filterProvider', '$provide',
  function ($controllerProvider, $compileProvider, $filterProvider, $provide) {
      // lazy controller, directive and service
      app.controller = $controllerProvider.register;
      app.directive  = $compileProvider.directive;
      app.filter     = $filterProvider.register;
      app.factory    = $provide.factory;
      app.service    = $provide.service;
      app.constant   = $provide.constant;
      app.value      = $provide.value;
  }
]).config(['$translateProvider', function($translateProvider){
  // Register a loader for the static files
  // So, the module will search missing translation tables under the specified urls.
  // Those urls are [prefix][langKey][suffix].
  $translateProvider.useStaticFilesLoader({
    prefix: 'l10n/',
    suffix: '.js'
  });
  // Tell the module what language to use by default
  $translateProvider.preferredLanguage('zn_CH');
  // Tell the module to store the language in the local storage
  $translateProvider.useLocalStorage();
}]).config(['$resourceProvider', function($resourceProvider){
  $resourceProvider.defaults.actions = {
    save:   {
      method: 'POST',
      headers: {Authorization: 'Bearer ' + getCookie('birdy_token')},
      transformResponse: function (data, headersGetter, status) {
        if (status === 401) {
          window.location.href = '/#/access/signin';
        } else {
          return JSON.parse(data);
        }
      }
    },
    get:    {
      method: 'GET',
      headers: {Authorization: 'Bearer ' + getCookie('birdy_token')},
      transformResponse: function (data, headersGetter, status) {
        if (status === 401) {
          window.location.href = '/#/access/signin';
        } else {
          return JSON.parse(data);
        }
      }
    },
    query:  {
      method: 'GET',
      isArray: false,
      headers: {Authorization: 'Bearer ' + getCookie('birdy_token')},
      transformResponse: function (data, headersGetter, status) {
        if (status === 401) {
          window.location.href = '/#/access/signin';
        } else {
          return JSON.parse(data);
        }
      }
    },
    update: {
      method: 'PUT',
      headers: {Authorization: 'Bearer ' + getCookie('birdy_token')},
      transformResponse: function (data, headersGetter, status) {
        if (status === 401) {
          window.location.href = '/#/access/signin';
        } else {
          return JSON.parse(data);
        }
      }
    },
    delete: {
      method: 'DELETE',
      headers: {Authorization: 'Bearer ' + getCookie('birdy_token')},
      transformResponse: function (data, headersGetter, status) {
        if (status === 401) {
          window.location.href = '/#/access/signin';
        } else {
          return JSON.parse(data);
        }
      }
    }
  };
}]);
