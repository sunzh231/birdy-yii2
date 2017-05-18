<template>
  <div id="demo-list">
    <el-row>
      <el-col :span="12">
        <el-form :inline="true" :model="searchParams">
          <el-col :span="6">
            <el-form-item>
              <el-input v-model="searchParams.name" placeholder="审批人"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="6">
            <el-form-item>
              <el-select v-model="searchParams.tel" placeholder="活动区域">
                <el-option label="区域一" value="shanghai"></el-option>
                <el-option label="区域二" value="beijing"></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-form-item>
            <el-button type="primary" @click="onSubmit()">查询</el-button>
            <el-button @click="reset()">重置</el-button>
          </el-form-item>
        </el-form>
      </el-col>
      <el-col :span="12" style="text-align: right;">
        <el-button type="primary">上传<i class="el-icon-upload el-icon--right"></i></el-button>
        <el-button type="primary" icon="plus" @click="handleEdit()"></el-button>
        <el-button type="danger" icon="delete" @click="handleDelete()"></el-button>
      </el-col>
    </el-row>

    <el-table v-loading="tableLoading" :data="tableData"
        element-loading-text="拼命加载中"
        @selection-change="handleSelectionChange()"
        highlight-current-row border style="width: 100%">
      <el-table-column type="selection" prop="id" width="50"></el-table-column>
      <el-table-column prop="name" fixed sortable label="姓名"></el-table-column>
      <el-table-column prop="tel" label="联系方式"></el-table-column>
      <el-table-column prop="email" label="电子邮箱"></el-table-column>
      <el-table-column inline-template fixed="right" label="操作" width="120" :context="_self">
        <span>
          <el-dropdown split-button type="success" size="small" style="padding-top: 8px;" @click="handleView($index, row)">
            查看
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item divided>
                <el-button type="text" @click="handleEdit($index, row)">编辑</el-button>
              </el-dropdown-item>
              <el-dropdown-item divided>
                <el-button type="text" @click="handleDelete($index, row)">删除</el-button>
              </el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </span>
      </el-table-column>
    </el-table>

    <div class="pagination">
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page="pagination.page + 1"
        :page-sizes="[20, 30, 50, 100, 200]"
        :page-size="pagination.size"
        layout="total, sizes, prev, pager, next, jumper"
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
        page: 0,
        size: 15,
        totalElements: 2
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
      this.$router.push({ path: `/demo/detail/${row.id}` })
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
      Object.assign(params, this.pagination, this.searchParams)
      this.demoService.get('/admin/demo/list', params).then((resp) => {
        if (resp.success) {
          this.tableData = resp.data.content
        } else {
          his.$notify({
            title: '加载失败',
            message: '网络异常，请稍后再试',
            type: 'error'
          })
        }
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
        this.demoService.remove(`/admin/demo/${ids}`).then((resp) => {
          if (resp.success) {

          } else {
            this.$notify({
              title: '删除失败',
              message: '网络异常，请稍后再试',
              type: 'error'
            })
          }
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
