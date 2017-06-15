// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import FastClick from 'fastclick'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import Validator from 'vue-validator'
import { WechatPlugin } from 'vux'

import App from './App'
import LoanApply from './components/LoanApply'
import LoanConfirm from './components/LoanConfirm'
import LoanList from './components/LoanList'
import Upload from './components/Upload'
import LoanEnd from './components/LoanEnd'

Vue.use(VueRouter)
Vue.use(VueResource)
Vue.use(Validator)
Vue.use(WechatPlugin)

const routes = [{
  path: '/',
  component: LoanApply
}, {
  path: '/confirm/:id',
  component: LoanConfirm
}, {
  path: '/list',
  component: LoanList
},{
  path: '/loanend',
  component: LoanEnd
}]

const router = new VueRouter({
  // mode: 'history',
  routes
})

FastClick.attach(document.body)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  router,
  render: h => h(App)
}).$mount('#app-box')
