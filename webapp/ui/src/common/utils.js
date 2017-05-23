import store from './store'

//首字母大写
const bigCamelCase = (str) => { // 正则法
  str = str.toLowerCase()
  const reg = /\b(\w)|\s(\w)/g //  \b判断边界\s判断空格
  return str.replace(reg, (m) => {
    return m.toUpperCase()
  })
}

//路由解析
const targetRoute = (str) => {
  const currentPath = store.state.targetRoute
  const target = currentPath.substring(1, currentPath.indexOf(`/${str}`))
  return target
}

module.exports = {
  bigCamelCase,
  targetRoute
}
