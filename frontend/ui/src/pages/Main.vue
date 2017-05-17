<template>
  <div id="main">
    <el-row>
      <el-col :span="4" class="left-side">
        <left-side :routes="routes"></left-side>
      </el-col>
      <el-col :span="20">
        <el-menu theme="dark" class="menus" default-active="1" mode="horizontal">
          <div class="right-operation">
            <el-popover ref="popover" placement="top-start" width="160" trigger="hover">
              <div style="text-align: right; margin: 0">
                <el-button size="mini" type="text">修改密码</el-button>
                <el-button type="danger" size="mini">退出系统</el-button>
              </div>
            </el-popover>
            <el-button v-popover:popover class="user-info">
              <img src=""/>
              <span>Admin</span>
            </el-button>
          </div>
        </el-menu>

        <el-row type="flex" class="row-bg" justify="center">
          <el-col :span="23">
            <div class="breadcrumb">
              <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                <el-breadcrumb-item>活动管理</el-breadcrumb-item>
                <el-breadcrumb-item>活动列表</el-breadcrumb-item>
                <el-breadcrumb-item>活动详情</el-breadcrumb-item>
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

export default {
  data () {
    return {
      showRight: true,
      routes: [
        {name: '贷款数据', icon: 'icon-user', route: '/user/list', subRoutes: []},
        {name: '后台用户管理', icon: 'icon-user', route: '/user/list', subRoutes: []},
        {name: '内容设置', icon: 'icon-setting', route: '/user/list', subRoutes: [
          {name: '轮播图设置', icon: 'icon-user', route: '/user/list'},
          {name: '页面引导语设置', icon: 'icon-user', route: '/user/list'},
          {name: '贷款确认链接设置', icon: 'icon-user', route: '/user/list'},
        ]}
      ]
    }
  },
  methods: {
  },
  components: {
    LeftSide
  }
}
</script>
