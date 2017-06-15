module.exports = {
  set(name, value, expiredays) {
    const exdate = new Date()
    exdate.setDate(exdate.getDate()+expiredays)
    document.cookie = name + "=" +escape(value) + ((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
  },
  get(name) {
    const reg = new RegExp("(^| )"+name+"=([^;]*)(;|$)")
    const arr = document.cookie.match(reg)
    if (arr) {
      return unescape(arr[2])
    } else {
      return null
    }
  },
  del(name) {
    const exp = new Date()
    exp.setTime(exp.getTime() - 1)
    const cval = getCookie(name)
    if(cval != null) {
      document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString()
    }
  }
};
