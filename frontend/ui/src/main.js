import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import VueValidator from 'vue-validator'

import ElementUI from 'element-ui'
import lang from 'element-ui/lib/locale/lang/zh-CN'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-default/index.css'

import routerConfig from './routers'
import Filters from './common/filters'
import { targetRoute } from './common/utils'
import App from './App'

locale.use(lang)

Filters(Vue)
Vue.use(VueRouter)
Vue.use(VueResource)
Vue.use(VueValidator)
Vue.use(ElementUI)
Vue.use(Vuex)

const routes = [
  {
    path: '/login',
    name: 'login',
    component (resolve) {
      require(['./pages/Login.vue'], resolve)
    }
  },
  {
    path: '/main',
    component (resolve) {
      require(['./pages/Main'], resolve)
    },
    children: [{
        path: '/:target/detail',
        component (resolve) {
          require([`./pages/cores/${targetRoute('detail')}/Detail`], resolve)
        }
      }, {
        path: '/:target/list',
        component (resolve) {
          require([`./pages/cores/${targetRoute('list')}/List`], resolve)
        }
      }]
  }
]

const router = new VueRouter({
  hashbang: false,
  history: false,
  saveScrollPosition: true,
  routes
})

const app = new Vue({
  render: h => h(App),
  router
}).$mount('#app')
