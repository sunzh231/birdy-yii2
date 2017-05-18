import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

import ElementUI from 'element-ui'
import lang from 'element-ui/lib/locale/lang/zh-CN'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-default/index.css'

import store from './common/store'
import cookie from './common/cookie'
import Filters from './common/filters'
import { targetRoute } from './common/utils'
import App from './App'

locale.use(lang)

Filters(Vue)
Vue.use(VueRouter)
Vue.use(VueResource)
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
    path: '/birdy',
    name: 'birdy',
    component (resolve) {
      require(['./pages/Birdy'], resolve)
    },
    children: [{
        path: '/setting/banner',
        name: 'banner',
        component (resolve) {
          require([`./pages/modules/setting/Banner`], resolve)
        }
      }, {
        path: '/:target/detail/:id',
        name: 'detail',
        component (resolve) {
          require([`./pages/modules/${targetRoute('detail')}/Detail`], resolve)
        }
      }, {
        path: '/:target/list',
        name: 'list',
        component (resolve) {
          require([`./pages/modules/${targetRoute('list')}/List`], resolve)
        }
      }, {
        path: '/dashboard',
        name: 'dashboard',
        component (resolve) {
          require([`./pages/Dashboard`], resolve)
        }
      }]
  },
  { path: '/', redirect: '/dashboard' }
]

const router = new VueRouter({
  mode: 'hash',
  routes
})

router.beforeEach((to, from, next) => {
  store.commit('changeRoute', to.path)
  next()
})

Vue.http.interceptors.push((request, next) => {
  Vue.http.headers.common['Authorization'] = `${cookie.get("birdy_token")}`
  next((response) => {
    if(response.status === 403 || response.status === 401) {
      window.location.href = '/admin#/login'
    }
    return response
  })
})

const app = new Vue({
  render: h => h(App),
  router
}).$mount('#app')
