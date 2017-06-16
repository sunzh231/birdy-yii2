<template>
  <div id="demo-list">
    <el-table v-loading="tableLoading" :data="tableData"
        element-loading-text="拼命加载中"
        @selection-change="handleSelectionChange()"
        highlight-current-row border style="width: 100%">
      <el-table-column type="selection" prop="id" width="50"></el-table-column>
      <el-table-column prop="name" fixed sortable label="姓名"></el-table-column>
      <el-table-column prop="tel" label="联系方式"></el-table-column>
      <el-table-column prop="loan_amount" label="贷款申请金额"></el-table-column>
      <el-table-column inline-template fixed="right" label="操作" width="120" :context="_self">
        <span>
          <el-button type="danger" @click="handleDelete($index, row)">删除</el-button>
        </span>
      </el-table-column>
    </el-table>

    <div class="pagination">
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page="pagination.page"
        :page-sizes="[10, 20, 50, 100, 200]"
        :page-size="pagination.size"
        layout="total, prev, pager, next, jumper"
        :total="pagination.totalElements">
      </el-pagination>
    </div>
    <edit
      :dialog-visible="dialogVisible"
      v-on:closeDialog="handleClose()"
      :table-row="target">
    </edit>
  </div>
</template>

<style scoped lang="less">
#demo-list {
  .pagination {
    text-align: center;
    margin-top: 20px;
  }
}
</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import Edit from './components/Edit'
import DemoStore from './LoanStore'
import DemoService from './LoanService'

export default {
  DemoStore,
  data() {
    return {
      searchParams: {
        name: '',
        tel: ''
      },
      tableLoading: false,
      demoService: new DemoService(this),
      tableData: [],
      pagination: {
        page: 1,
        size: 10,
        totalElements: 0
      },
      multipleSelection: [],
      dialogVisible: false,
      target: {}
    }
  },
  created () {
    this.getDemos()
  },
  methods: {
    handleSelectionChange (val) {
      this.multipleSelection = val
    },
    handleSizeChange(val) {
      this.pagination.size = val
      this.getDemos()
    },
    handleCurrentChange(val) {
      this.pagination.page = val
      this.getDemos()
    },
    handleView (index, row) {
      // this.$router.push({ path: `/demo/detail/${row.id}` })
    },
    handleEdit (index, row) {
      this.dialogVisible = true
      if (row) {
        this.target = row
      }
    },
    handleDelete (index, row) {
      if (row) {
        this.deleteDemos(row.id)
      } else {
        if (!this.multipleSelection) {
          this.$message({
            message: '请选择要删除的数据',
            type: 'warning'
          })
        } else {
          let ids = ''
          for(let v of this.multipleSelection) {
            console.log(v); // red green blue
            if (ids) {
              ids += `,${v.id}`
            } else {
              ids += v.id
            }
          }
          this.deleteDemos(ids)
        }
      }
    },
    handleClose () {
      this.dialogVisible = false
    },
    onSubmit () {
      this.getDemos()
    },
    reset () {
      this.searchParams = {}
    },
    getDemos () {
      this.tableLoading = true
      let params = {}
      // Object.assign(params, this.pagination, this.searchParams)
      this.demoService.get(`/api/loan/index?page=${this.pagination.page}&access-token=abc123_`, params).then((resp) => {
        this.tableData = resp.items
        this.pagination.page = resp._meta.currentPage
        this.pagination.totalElements = resp._meta.totalCount
        console.log(this.pagination)
      }).catch((resp) => {
        this.$notify({
          title: '加载失败',
          message: '网络异常，请稍后再试',
          type: 'error'
        })
      }).finally(() => {
        this.tableLoading = false
      })
    },
    deleteDemos (ids) {
      this.$confirm('此操作将永久删除该数据, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        this.demoService.remove(`/api/loan/delete/${ids}?access-token=abc123_`).then((resp) => {
          this.tableData = resp.items
          this.pagination.page = resp._meta.currentPage
          this.pagination.totalElements = resp._meta.totalCount
        }).catch((resp) => {
          this.$notify({
            title: '删除失败',
            message: '网络异常，请稍后再试',
            type: 'error'
          })
        }).finally(() => {
          console.log('456')
        })
      }).catch(() => {
        this.$message({
          type: 'info',
          message: '已取消删除'
        })
      })
    }
  },
  components: {
    Edit
  }
}
</script>
