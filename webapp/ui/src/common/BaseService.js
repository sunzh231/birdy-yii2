export default class {
  constructor(vm) {
    this.vm = vm;
  }

  create (url, params=null) {
    const resource = this.vm.$resource(url)
    return resource.save(this.vm.target).then((resp) => {
      return resp.data
    })
  }

  update (url, params=null) {
    const resource = this.vm.$resource(url)
    return resource.update(this.vm.target).then((resp) => {
      return resp.data
    })
  }

  get (url, params=null) {
    const resource = this.vm.$resource(url)
    return resource.get(params).then((resp) => {
      return resp.data
    })
  }

  remove (url, params=null) {
    const resource = this.vm.$resource(url)
    return resource.delete().then((resp) => {
      return resp.data
    })
  }
}
