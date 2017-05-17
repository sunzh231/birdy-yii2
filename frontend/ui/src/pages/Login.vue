<template>
  <div id="birdy-login">
    <el-row class="container">
      <el-col :span="12">
        123
      </el-col>
      <el-col :span="6">
        <el-form :model="loginForm" :rules="rules" ref="loginForm" class="login-form">
          <div class="form-title"><i class="iconfont icon-user"></i>登录</div>
          <el-form-item prop="username">
            <el-input type="text" v-model="loginForm.username" placeholder="用户名">
            </el-input>
          </el-form-item>
          <el-form-item prop="pass">
            <el-input type="password" v-model="loginForm.pass" placeholder="密码" auto-complete="off"></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" size="large" class="login-btn" :loading="loginLoading" @click="handleSubmit">登录</el-button>
          </el-form-item>
        </el-form>
      </el-col>
    </el-row>
  </div>
</template>

<style lang="less">
@import '../assets/styles/variables.less';

#birdy-login {
  .container {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: @baseBlue;
    padding-top: 240px;

    .login-form {
      width: 300px;
      border: @lightGray solid 1px;
      padding: 30px;
      border-radius: 8px;
      background: @baseWhite;

      .form-title {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: @darkBule;
      }

      .login-btn {
        width: 100%;
      }
    }
  }
}
</style>

<script>
import service from './loginService'

export default {
  data() {
    return {
      loginLoading: false,
      loginForm: {
        username: '',
        pass: ''
      },
      rules: {
        username: [{ required: true, message: '请输入用户名', trigger: 'blur' }],
        pass: [{ required: true, message: '请输入密码', trigger: 'blur' }]
      }
    };
  },
  methods: {
    handleSubmit(event) {
      this.$refs.loginForm.validate((valid) => {
        if (valid) {
          this.login()
        } else {
          return false
        }
      });
    },
    login () {
      this.loginLoading = true
      service.login(this).then((resp) => {
        if (resp.msg === 'ok') {
          this.$router.go({
            path: '/main/dashboard'
          })
        } else {
          this.$notify({
            title: '登录失败',
            message: '用户名或密码错误',
            type: 'error'
          })
        }
      }).catch((resp) => {
        this.$notify({
          title: '登录失败',
          message: '网络异常，请稍后再试',
          type: 'error'
        })
      }).finally(() => {
        this.loginLoading = false
      })
    }
  }
}
</script>
