import config from '../config.js';
import Vue from 'Vue';
import VueResource from 'vue-resource';
// import cookie from 'src/common/cookie';
Vue.use(VueResource);
Vue.http.options.emulateJSON = true;

module.exports = {
  // ajax(method, options) {
  //   const debugInfo = config.DEBUGAPI[options.apiName];
  //   let path = "";
  //   if (debugInfo && debugInfo.toUpperCase() === method.toUpperCase()) {
  //     path = config.DEBUG_PATH;
  //   } else {
  //     path = config.SERVER_PATH;
  //   }
  //   if (method.toUpperCase() === 'GET' || method.toUpperCase() === 'DELETE') {
  //     return Vue.http[method](path + options.apiName, { params: options.params, headers: { token: cookie.get("token")+'' } });
  //   } else {
  //     return Vue.http[method](path + options.apiName, options.params, { headers: { token: cookie.get("token")+'' } });
  //   }
  // },

  service () {
    
  }
};
