<template >
  <div id="loan_list">
    <group>
      <div v-for="item in loans" @click="detail(item.id, $event)">
        <cell-box is-link>
          <span>{{item.name}}</span>微信贷款信息核对确认书
        </cell-box>
      </div>
    </group>
    <div class="btn-wrap">
      <box gap="10px 10px" class="btn-group">
        <span @click="pageChange(-1)">
          <x-button type="default" mini class="apply-btn">上一页</x-button>
        </span>
        <span class="page-info">
          {{page}}/{{pageCount}}
        </span>
        <span @click="pageChange(1)">
          <x-button type="default" mini class="apply-btn">下一页</x-button>
        </span>
      </box>
    </div>
  </div>
</template>

<script>
import BirdyService from '../BirdyService'
import { Group, Cell, CellBox, XButton, Box } from 'vux'

export default {
  data () {
    return {
      birdyService: new BirdyService(this),
      loans: [],
      page: 1,
      pageCount: 1
    }
  },
  created () {
    this.init()
  },
  methods: {
    init () {
      this.getData(this.page)
    },
    detail (id, event) {
      event.preventDefault()
      this.$router.push({ path: `/confirm/${id}` })
    },
    getData (page) {
      this.birdyService.get(`/api/loan/index?page=${page}&access-token=abc123_`).then((resp) => {
        this.loans = resp.items
        this.pageCount = resp._meta.pageCount
      }).catch((resp) => {

      }).finally(() => {

      })
    },
    pageChange (operation) {
      if (operation == -1) {
        if (this.page > 1) {
          this.page = this.page + operation
        }
      }
      if (operation == 1) {
        if (this.page < this.pageCount) {
          this.page = this.page + operation
        }
      }
      this.getData(this.page)
    }
  },
  components: {
    Group, Cell, CellBox, XButton, Box
  }
}
</script>

<style scoped lang="less">
@import '../assets/styles/variables.less';

#loan_list {
  .btn-wrap {
    width: 240px;
    margin: 10px auto;
    .btn-group {
      .page-info {
        width: 80px;
      }
    }
  }
}
</style>
