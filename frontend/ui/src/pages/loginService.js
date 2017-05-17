const login = (vm) => {
  console.log(vm)
  const resource = vm.$resource('/api/user/login')
  return resource.save(vm.user).then((resp) => {
    return resp.data
  })
}

module.exports = {
  login
}
