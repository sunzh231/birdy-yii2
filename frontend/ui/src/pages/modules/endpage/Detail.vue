<template>
  <div id="demo-detail">
    12321
  </div>
</template>

<style scoped lang="less">
@import './demo.less';

</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import Edit from './components/Edit'
import DemoStore from './DemoStore'
import DemoService from './DemoService'

export default {
  data() {
    return {
    }
  },
  methods: {
  },
  components: {
    Edit
  }
}
</script>
