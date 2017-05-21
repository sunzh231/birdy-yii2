<template>
  <div id="demo-detail">
    <el-form ref="form" :model="target" label-width="80px">
      <el-form-item label="活动形式">
        <el-upload
          class="upload-demo"
          action="api/upload/file"
          :on-remove="handleRemove"
          :before-upload="uploadCheck"
          :on-success="onSuccess"
          :file-list="target.banners"
          list-type="picture">
          <el-button size="small" type="primary">点击上传</el-button>
          <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
        </el-upload>
      </el-form-item>
      <el-form-item label="贷款说明">
        <el-input type="textarea" v-model="target.description"></el-input>
      </el-form-item>
      <el-form-item label="确认书跳转链接">
        <el-input v-model="target.link"></el-input>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="onSubmit">立即创建</el-button>
        <el-button>取消</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<style scoped lang="less">
@import './setting.less';

</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import DemoStore from './SettingStore'
import DemoService from './SettingService'

export default {
  data() {
    return {
      demoService: new DemoService(this),
      bannerMap: new Map(),
      target: {
        link: '',
        description: '',
        banners: []
      }
    }
  },
  created () {
    this.init()
  },
  methods: {
    init () {
      this.demoService.get('/api/content/view/1?access-token=abc123_').then((resp) => {
        this.target = resp.content

        for (let banner of resp.banners) {
          this.bannerMap.set(banner.name, banner.url)
        }
        this.target.banners = resp.banners
      }).catch((resp) => {
        this.$notify({
          title: '加载失败',
          message: '网络异常，请稍后再试',
          type: 'error'
        })
      }).finally(() => {

      })
    },
    handleRemove (file, fileList) {
      if (file && this.bannerMap.size >= 1 && this.bannerMap.size <=3) {
        this.bannerMap.delete(file.name)
      }
    },
    uploadCheck (file) {
      if (this.bannerMap.size >= 3) {
        this.$notify({
          title: '上传失败',
          message: '轮播图最多上传三张图片',
          type: 'error'
        })
        return false
      }
    },
    onSuccess (response, file, fileList) {
      this.bannerMap.set(response.name, response.path)
      this.target.banners.push(response.path)
    },
    onSubmit () {
      this.target.banners = [...this.bannerMap]
      this.demoService.update('/api/content/update/1?access-token=abc123_', this.target).then((resp) => {
        this.$notify({
          title: '更新成功',
          message: '网页内容更新成功',
          type: 'success'
        })
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
  }
}
</script>
