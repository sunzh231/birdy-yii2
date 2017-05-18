<template>
  <div id="main">
    <el-row>
      <el-col :span="4" class="left-side">
        <left-side :routes="menus"></left-side>
      </el-col>
      <el-col :span="20">
        <el-menu theme="dark" class="menus" default-active="1" mode="horizontal">
          <div v-for="(item, index) in modules" v-if="index < 5">
            <el-menu-item :index="index+1+''" @click="handleModule">{{ item.name }}</el-menu-item>
          </div>
          <el-submenu v-if="menus.length > 6" index="5">
            <template slot="title">更多</template>
            <div v-for="(item, index) in modules" v-if="index > 5">
              <el-menu-item :index="5+'-'+(index+1)">{{ item.name }}</el-menu-item>
            </div>
          </el-submenu>
          <div class="right-operation">
            <el-popover ref="popover" placement="top-start" trigger="hover">
              <div class="user-info-detail">
                <img src="http://localhost:8888/upload/avatar/default.jpeg" width="100px"/>
                <el-row class="user-operation">
                  <el-col :span="10">
                    <span>Admin</span>
                  </el-col>
                  <el-col :span="4">
                    <span>|</span>
                  </el-col>
                  <el-col :span="10">
                    <span>系统管理员</span>
                  </el-col>
                </el-row>
              </div>
              <el-row class="user-operation">
                <el-col :span="12">
                  <el-button size="mini" type="text" class="change-pwd">修改密码</el-button>
                </el-col>
                <el-col :span="12">
                  <el-button type="danger" size="mini" class="logout">退出系统</el-button>
                </el-col>
              </el-row>
            </el-popover>
            <el-button v-popover:popover class="user-info">
              <img src="http://localhost:8888/upload/avatar/default.jpeg"/>
              <span>Admin</span>
            </el-button>
          </div>
        </el-menu>

        <el-row type="flex" class="row-bg" justify="center">
          <el-col :span="23">
            <div class="breadcrumb">
              <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <el-breadcrumb-item v-for="item in breadcrumbs" :to="{ path: item.path }">{{ item.name }}</el-breadcrumb-item>
              </el-breadcrumb>
            </div>

            <router-view></router-view>
          </el-col>
        </el-row>
      </el-col>
    </el-row>
  </div>
</template>

<style scoped lang="less">
@import '../assets/styles/variables.less';

.el-popover {
  text-align: center;
  padding: 0;

  .user-info-detail {
    cursor: pointer;
    text-align: center;
    background: @deepGreen;
    width: 180px;
    padding: 5px;

    img {
      margin: 0 auto;
      display: block;
      border-radius: 50%;
      margin-bottom: 5px;
    }
    span {
      color: @baseWhite;
      font-size: 14px;
    }
  }

  .user-operation {
    margin-top: 5px;
    .change-pwd {
      float: left;
    }
    .logout {
      float: right;
    }
  }
}

#main {
  .menus {
    .right-operation {
      float: right;
      height: 60px;
      padding: 0 20px;

      .user-info {
        height: 100%;
        clear: both;
        background: @lightBlack;
        color: @baseWhite;
        font-size: 16px;
        border: none;
        line-height: 55px;
        padding: 5px 0;

        img {
          width: 50px;
          height: 50px;
          border-radius: 50%;
          float: left;
          background: @baseWhite;
        }

        span {
          margin-left: 10px;
          float: left;
        }
      }
    }
  }

  .breadcrumb {
    padding: 20px 0;
  }
}
</style>

<script>
import LeftSide from 'components/LeftSide'
import BirdyService from './BirdyService'

export default {
  data () {
    return {
      birdyService: new BirdyService(this),
      modules: [],
      menus: [
        {name: '贷款数据', icon: 'el-icon-star-on', url: '/loan/list', subMenus: []},
        {name: '后台用户管理', icon: 'el-icon-star-on', url: '/user/list', subMenus: []},
        {name: '内容设置', icon: 'el-icon-setting', url: '/user/list', subMenus: [
          {name: '轮播图设置', icon: 'icon-user', url: '/setting/banner'},
          {name: '页面引导语设置', icon: 'icon-user', url: '/user/list'},
          {name: '贷款确认链接设置', icon: 'icon-user', url: '/user/list'},
        ]}
      ],
      breadcrumbs: [
        {name: '用户列表', path: '/user/list'},
        {name: '用户详情', path: '/user/list'},
      ]
    }
  },
  created () {
    this.init("58565d14a31e25262962e4f8")
  },
  methods: {
    init (id) {
      // this.getAccount(id)
    },
    handleModule (id) {
      this.getModule(id)
    },
    getAccount (id) {
      this.birdyService.get(`/account/${id}`).then((resp) => {
        if (resp.success) {
          this.modules = resp.data.modules
          this.menus = this.modules[0].menus
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
    getModule (id) {
      this.birdyService.get(`/module/${id}`).then((resp) => {
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
    }
  },
  components: {
    LeftSide
  }
}
</script>
