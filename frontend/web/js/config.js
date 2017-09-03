// config

var app =
angular.module('app')
  .config(
    ['$controllerProvider', '$compileProvider', '$filterProvider', '$provide',
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
  ])
  .config(['$translateProvider', function($translateProvider){
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
  }])
  .config(['$resourceProvider', function($resourceProvider){
    $resourceProvider.defaults.actions = {
      create: {method: 'POST', headers: {Authorization: 'Bearer 123456'}},
      get:    {method: 'GET', headers: {Authorization: 'Bearer 123456'}},
      query:  {method: 'GET', isArray: false, headers: {Authorization: 'Bearer 123456'}},
      update: {method: 'PUT', headers: {Authorization: 'Bearer 123456'}},
      delete: {method: 'DELETE', headers: {Authorization: 'Bearer 123456'}}
    };
  }]);
