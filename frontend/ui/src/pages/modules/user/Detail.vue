<template>
  <div id="user-detail">
    <el-row>
      <el-col :span="24" class="operation">
        <el-button type="success" icon="edit" @click="handleEdit()"></el-button>
        <el-button type="primary" icon="share"></el-button>
        <el-button type="danger" icon="delete" @click="handleDelete()"></el-button>
      </el-col>
    </el-row>
    <el-row class="row-margin">
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">123</el-col>
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">12312</el-col>
    </el-row>
    <el-row class="row-margin">
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">qewqewqewqewqewqewqewqewqewqewqewqeqwewqewqewq</el-col>
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">12312</el-col>
    </el-row>
    <el-row class="row-margin">
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">Hello world!Hello world!Hello world!Hello world!Hello world!Hello world!</el-col>
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">Hello world!Hello world!Hello world!Hello world!Hello world!Hello world!</el-col>
    </el-row>
    <el-row class="row-margin">
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">测试文件测试文件测试文件测试文件测试文件测试文件测试文件测试文件测试文件测试文件测试文件测试文件测试文件</el-col>
      <el-col :span="3" class="label-control">Name Lable:</el-col>
      <el-col :span="8" class="content">12312</el-col>
    </el-row>
    <edit
      :dialog-visible="dialogVisible"
      v-on:closeDialog="handleClose"
      :table-row="target">
    </edit>
  </div>
</template>

<style scoped lang="less">
@import './user.less';

#user-detail {
  .operation {
    text-align: right;
  }

  .row-margin {
    margin: 20px 0;

    .label-control {
      text-align: right;
    }

    .content {
      margin-left: 10px;
      word-wrap: break-word;
    }
  }
}

</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import Edit from './components/Edit'
import UserStore from './UserStore'
import UserService from './UserService'

export default {
  data() {
    return {
      dialogVisible: false,
      userService: new UserService(this),
      target: {}
    }
  },
  created () {
    this.getUser()
  },
  methods: {
    handleEdit () {
      this.dialogVisible = true
    },
    handleDelete () {
      this.deleteUser(this.$route.params.id)
    },
    handleClose (type) {
      this.dialogVisible = false
      if (type === 'success') {
        this.getUser()
      }
    },
    getUser () {
      this.userService.get(`/user/${this.$route.params.id}`).then((resp) => {
        if (resp.success) {
          this.target = resp.data
        } else {
          this.$notify({
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

      })
    },
    deleteUser (id) {
      this.$confirm('此操作将永久删除该数据, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).then(() => {
        this.userService.remove(`/user/${id}`).then((resp) => {
          if (resp.success) {
            this.$router.push({ path: '/user/list' })
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
      })
    }
  },
  components: {
    Edit
  }
}
</script>
