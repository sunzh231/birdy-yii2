import BaseService from 'src/common/BaseService'

export default class extends BaseService {
  constructor(vm) {
    super(vm)
    this.vm = vm
  }

  login (url, params=null) {
    const resource = this.vm.$resource(url)
    return resource.save(this.vm.target).then((resp) => {
      return resp.data
    })
  }
}
