<template>
  <div id="user-editor">
    <el-dialog title="编辑用户" v-model="dialogVisible" v-on:close="handleClose()">
      <el-form :model="target" :rules="rules" ref="ruleForm" :label-width="formLabelWidth">
        <el-form-item label="用户名" prop="name">
          <el-input v-model="target.name" placeholder="请输入用户名"></el-input>
        </el-form-item>
        <el-form-item label="密码" prop="password">
          <el-input type="password" v-model="target.password" placeholder="请输入密码"></el-input>
        </el-form-item>
        <el-form-item label="密码确认" prop="repassword">
          <el-input type="password" v-model="target.repassword" placeholder="请再次输入密码"></el-input>
        </el-form-item>
        <el-form-item label="电子邮箱" prop="email">
          <el-input v-model="target.email" placeholder="请输入电子邮箱"></el-input>
        </el-form-item>
        <el-form-item label="手机号码" prop="tel">
          <el-input v-model="target.tel" placeholder="请输入手机号码"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="handleClose()">取 消</el-button>
        <el-button type="primary" :loading="btnLoading" @click="handleSubmit()">立即创建</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import UserStore from '../UserStore'
import UserService from '../UserService'
import Regular from 'src/common/regular'

export default {
  props: {
    formLabelWidth: {
      type: String,
      required: false,
      default: '120px'
    },
    dialogVisible: {
      type: Boolean,
      required: true,
      default: false
    },
    tableRow: {
      type: Object,
      required: false,
      default: {}
    }
  },
  data() {
    const validatePassword = (rule, value, callback) => {
      if (value !== this.target.password) {
        callback(new Error('两次输入密码不一致!'))
      } else {
        callback()
      }
    }

    const validateTel = (rule, value, callback) => {
      if (!Regular.tel.test(value)) {
        callback(new Error('请输入正确手机号码'));
      } else {
        callback()
      }
    }
    return {
      target: {
        name: '',
        password: '',
        repassword: '',
        email: '',
        tel: ''
      },
      btnLoading: false,
      userService: new UserService(this),
      rules: {
        name: [
          { required: true, message: '请输入用户名', trigger: 'blur' },
          { min: 3, max: 20, message: '长度在 3 到 20 个字符', trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入密码', trigger: 'blur' },
          { min: 6, max: 20, message: '长度在 6 到 20 个字符', trigger: 'blur' }
        ],
        repassword: [
          { required: true, message: '请输入再次密码', trigger: 'blur' },
          { min: 6, max: 20, message: '长度在 6 到 20 个字符', trigger: 'blur' },
          { validator: validatePassword, trigger: 'blur' }
        ],
        email: [
          { required: true, message: '请输入电子邮箱', trigger: 'blur' },
          { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur,change' }
        ],
        tel: [
          { required: true, message: '请输入手机号码', trigger: 'blur' },
          { min: 11, max: 11, message: '请输入11位手机号码', trigger: 'blur' },
          { validator: validateTel, trigger: 'blur,change' }
        ],
      }
    };
  },
  watch: {
    tableRow: function (val) {
      Object.assign(this.target, val)
    }
  },
  methods: {
    handleClose () {
      this.$refs.ruleForm.resetFields()
      this.$emit('closeDialog')
    },
    handleSubmit(ev) {
      this.$refs.ruleForm.validate((valid) => {
        if (valid) {
          this.btnLoading = true
          if (this.target.id) {
            this.updateUser()
          } else {
            this.createUser()
          }
        } else {
          return false;
        }
      });
    },
    createUser () {
      this.userService.create('/user/save').then((resp) => {
        if (resp.success) {
          this.$emit('closeDialog', 'success')
        } else {
          this.$notify({
            title: '创建失败',
            message: '网络异常，请稍后再试',
            type: 'error'
          })
        }
      }).catch((resp) => {
        this.$notify({
          title: '创建失败',
          message: '网络异常，请稍后再试',
          type: 'error'
        })
      }).finally(() => {
        this.btnLoading = false
      })
    },
    updateUser () {
      this.userService.update('/user/update').then((resp) => {
        if (resp.success) {
          this.$emit('closeDialog', 'success')
        } else {
          this.$notify({
            title: '更新失败',
            message: '网络异常，请稍后再试',
            type: 'error'
          })
        }
      }).catch((resp) => {
        this.$notify({
          title: '更新失败',
          message: '网络异常，请稍后再试',
          type: 'error'
        })
      }).finally(() => {
        this.btnLoading = false
      })
    }
  }
}
</script>
