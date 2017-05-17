<template>
  <div id="user-list">
    <el-row>
      <el-col :span="12">
        <el-form :inline="true" :model="formInline" class="demo-form-inline">
          <el-col :span="6">
            <el-form-item>
              <el-input v-model="formInline.user" placeholder="审批人"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="6">
            <el-form-item>
              <el-select v-model="formInline.region" placeholder="活动区域">
                <el-option label="区域一" value="shanghai"></el-option>
                <el-option label="区域二" value="beijing"></el-option>
              </el-select>
            </el-form-item>
          </el-col>
          <el-form-item>
            <el-button type="primary" @click="onSubmit">查询</el-button>
            <el-button @click="reset">重置</el-button>
          </el-form-item>
        </el-form>
      </el-col>
      <el-col :span="12" style="text-align: right;">
        <el-button type="primary">上传<i class="el-icon-upload el-icon--right"></i></el-button>
        <el-button type="primary" icon="plus" @click.native="dialogVisible = true"></el-button>
        <el-button type="danger" icon="delete"></el-button>
      </el-col>
    </el-row>

    <el-table v-loading="loading" element-loading-text="拼命加载中" :data="tableData3" border style="width: 100%">
      <el-table-column type="selection" width="50"></el-table-column>
      <el-table-column fixed sortable prop="date" label="日期" width="150"></el-table-column>
      <el-table-column prop="name" label="姓名" width="120"></el-table-column>
      <el-table-column prop="province" label="省份" width="120"></el-table-column>
      <el-table-column prop="city" label="市区" width="120"></el-table-column>
      <el-table-column prop="address" label="地址" width="300"></el-table-column>
      <el-table-column prop="zip" label="邮编" width="120"></el-table-column>
      <el-table-column inline-template fixed="right" label="操作" width="120">
        <span>
          <el-dropdown split-button type="success" size="small" style="padding-top: 8px;" @click="handleOperation">
            查看
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item divided>
                <el-button type="text" @click="handleEdit()">编辑</el-button>
              </el-dropdown-item>
              <el-dropdown-item divided>
                <el-button type="text" @click="handleDelete()">删除</el-button>
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
        :current-page="5"
        :page-sizes="[100, 200, 300, 400]"
        :page-size="100"
        layout="total, sizes, prev, pager, next, jumper"
        :total="400">
      </el-pagination>
    </div>
    <edit v-ref:visible></edit>
    <!-- <el-dialog title="收货地址" v-model="dialogFormVisible">
      <el-form :model="form">
        <el-form-item label="活动名称" :label-width="formLabelWidth">
          <el-input v-model="form.name" auto-complete="off"></el-input>
        </el-form-item>
        <el-form-item label="活动区域" :label-width="formLabelWidth">
          <el-select v-model="form.region" placeholder="请选择活动区域">
            <el-option label="区域一" value="shanghai"></el-option>
            <el-option label="区域二" value="beijing"></el-option>
          </el-select>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click.native="dialogFormVisible = false">取 消</el-button>
        <el-button type="primary" @click.native="dialogFormVisible = false">确 定</el-button>
      </div>
    </el-dialog> -->
  </div>
</template>

<style scoped lang="less">
#user-list {
  .pagination {
    text-align: center;
    margin-top: 20px;
  }
}
</style>

<script>
import Edit from './components/Edit'
export default {
  data() {
    return {
      formInline: {
        user: '',
        region: ''
      },
      loading: false,
      tableData3: [{
        date: '2016-05-03',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }, {
        date: '2016-05-02',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }, {
        date: '2016-05-04',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }, {
        date: '2016-05-01',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }, {
        date: '2016-05-08',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }, {
        date: '2016-05-06',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }, {
        date: '2016-05-07',
        name: '王小虎',
        province: '上海',
        city: '普陀区',
        address: '上海市普陀区金沙江路 1518 弄',
        zip: 200333
      }],
      dialogVisible: false,
      form: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: ''
      },
      formLabelWidth: '120px'
    }
  },
  methods: {
    handleSizeChange(val) {
      console.log(`每页 ${val} 条`)
    },
    handleCurrentChange(val) {
      console.log(`当前页: ${val}`)
    },
    handleOperation () {

    },
    handleEdit () {
      console.log('edit!')
      this.$refs.visible.fromParent()
      // this.dialogVisible = true
    },
    handleDelete () {
      console.log('delete!')
    },
    reset () {

    },
    onSubmit() {
      console.log('submit!')
    }
  },
  components: {
    Edit
  }
}
</script>
