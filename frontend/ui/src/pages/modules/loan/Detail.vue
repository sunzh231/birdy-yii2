<template>
  <div id="demo-detail">
    12321
  </div>
</template>

<style scoped lang="less">
@import './loan.less';

</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import Edit from './components/Edit'
import DemoStore from './LoanStore'
import DemoService from './LoanService'

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
