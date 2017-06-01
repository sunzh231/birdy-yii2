const rmbFormat = (value) => {
  let result = ''
  let strs = []
  if (typeof (value) === 'string') {
    value = parseFloat(value)
  }
  if (value) {
    strs = value.toFixed(2).toString().split('.')
    while (strs[0].length > 3) {
      result = `,${strs[0].slice(-3)}${result}`
      strs[0] = strs[0].slice(0, strs[0].length - 3)
    }
    if (strs[0]) {
      result = `${strs[0]}${result}`
    }
  } else {
    result = '0'
    return `￥${result}.00`
  }
  return `￥${result}.${strs[1]}`
}

export default function (Vue) {
  Vue.filter('universal', (value, type) => {
    let newly = value
    switch (type) {
      case 'rmb':
        newly = rmbFormat(value)
        break
      default:
        newly = `${value}`
    }
    return newly
  })
}
