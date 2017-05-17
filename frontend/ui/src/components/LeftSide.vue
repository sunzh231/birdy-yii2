<template>
  <div class="birdy-left-side">
    <el-row>
      <el-col :span="24">
        <h5 class="logo">Birdy</h5>
        <el-menu default-active="0">
          <el-menu-item index="0">
            <i class="el-icon-menu"></i>
            首页
          </el-menu-item>
          <div v-for="(item, index) in routes">
            <el-submenu v-if="item.subRoutes && item.subRoutes.length > 0" :index="index+1+''">
              <template slot="title">
                <i class="el-icon-setting"></i>
                {{item.name}}
              </template>
              <el-menu-item
                v-for="(subItem, subIndex) in item.subRoutes"
                :index="index+'-'+subIndex">
                {{subItem.name}}
              </el-menu-item>
            </el-submenu>
            <el-menu-item v-else :index="index + 1 + ''">
              <i class="el-icon-star-on"></i>
              {{item.name}}
            </el-menu-item>
          </div>
        </el-menu>
      </el-col>
    </el-row>
  </div>
</template>

<style scoped lang="less">
@import '../assets/styles/variables.less';

.birdy-left-side {
  min-height: 800px;
  background: @dartWhite;

  .logo {
    font-size: 32px;
    height: 60px;
    margin: 0;
    line-height: 60px;
    color: @deepGreen;
    text-align: center;
    background: @youngBlack;
  }
}
</style>

<script>
export default {
  props: {
    routes: {
      type: Array,
      required: true,
      default: function () {
        return []
      }
    }
  },
  methods: {
  }
}
</script>
