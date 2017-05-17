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
  const url = window.location.href
  const target = url.substring(url.indexOf('#') + 2, url.indexOf(`/${str}`))
  return target
}

module.exports = {
  bigCamelCase,
  targetRoute
}
