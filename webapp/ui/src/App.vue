<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<script>
import BirdyService from './BirdyService'

export default {
  name: 'app',
  data () {
    return {
      birdyService: new BirdyService(this),
      config: {}
    }
  },
  created () {
    this.pageInit()
  },
  methods: {
    pageInit () {
      
    }
  }
}
</script>

<style lang="less">
@import '~vux/src/styles/reset.less';

body {
  background-color: #fbf9fe;
}
</style>
