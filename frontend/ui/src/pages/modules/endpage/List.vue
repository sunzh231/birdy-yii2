<template>
  <div id="end-page">
    <el-form ref="form" :model="target" label-width="80px">
      <el-form-item label="标题">
        <el-input v-model="target.title"></el-input>
      </el-form-item>
      <el-form-item label="图片设置">
        <el-upload
          class="upload-demo"
          action="/api/upload/file"
          :on-remove="handleRemove"
          :before-upload="uploadCheck"
          :on-success="onSuccess"
          :file-list="target.banners"
          list-type="picture">
          <el-button size="small" type="primary">点击上传</el-button>
          <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
        </el-upload>
      </el-form-item>
      <el-form-item label="二维码引导语">
        <el-input type="textarea" v-model="target.pic"></el-input>
      </el-form-item>
      <el-form-item label="二维码设置">
        <el-upload
          class="upload-demo"
          action="/api/upload/file"
          :on-remove="handleRemoveQr"
          :before-upload="uploadCheckQr"
          :on-success="onSuccessQr"
          :file-list="target.qr"
          list-type="picture">
          <el-button size="small" type="primary">点击上传</el-button>
          <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
        </el-upload>
      </el-form-item>
      <el-form-item label="常见问题标题">
        <el-input type="textarea" v-model="target.description"></el-input>
      </el-form-item>
      <el-form-item label="常见问题设置">
        <el-button type="primary" class="add-issue" @click="addIssue" icon="plus">添加</el-button>
        <div v-for="(item, index) in target.issues" class="issue-item">
          <el-form-item label="问题">
            <el-col class="mb-20" :span="18">
              <el-input  v-model="item.question"></el-input>
            </el-col>
          </el-form-item>
          <el-form-item label="解答">
            <el-col :span="18">
              <el-input type="textarea" v-model="item.answer"></el-input>
            </el-col>
          </el-form-item>
          <el-button type="danger" @click="removeIssue(index)" icon="delete">删除</el-button>
        </div>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="onSubmit">保存</el-button>
        <el-button>取消</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<style scoped lang="less">
@import '../../../assets/styles/variables.less';

#end-page {
  margin-top: 20px;

  .issue-item {
    padding: 20px;
    border: solid 1px @baseGray;
    border-radius: 3px;
    margin-bottom: 20px;
    .mb-20 {
      margin-bottom: 20px;
    }
    .el-icon-delete {
      color: @baseRed;
      font-size: 20px;
    }
  }
  .pull-right {
    float: right;
  }
  .add-issue {
    margin: 10px 0px;
  }
}
</style>

<script>
import { mapGetters, mapActions } from 'vuex'
import DemoStore from './DemoStore'
import DemoService from './DemoService'

export default {
  DemoStore,
  data() {
    return {
      demoService: new DemoService(this),
      bannerMap: new Map(),
      target: {
        title: '',
        pic: '',
        description: '',
        banners:[],
        qr: [],
        issues: [
          {
            question: '',
            answer: ''
          }
        ]
      }
    }
  },
  created () {
    this.getDemos()
  },
  methods: {
    getDemos () {
      this.demoService.get('/api/endpage/view/1?access-token=abc123_').then((resp) => {
        let qr = []
        let pics = []
        for (let p of resp.pics) {
          if (p.name == 'qr') {
            qr.push(p)
          } else {
            pics.push(p)
            this.bannerMap.set(p.name, p.url)
          }
        }
        this.target = {
          title: resp.content.title,
          pic: resp.content.pic,
          description: resp.content.description,
          banners: pics,
          qr: qr,
          issues: resp.issues
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
    addIssue () {
      this.target.issues.push({
        question: '',
        answer: ''
      })
    },
    removeIssue (index) {
      let issueMap = new Map()
      let i = 0
      for (let v of this.target.issues) {
        issueMap.set(i, v)
        i++
      }
      issueMap.delete(index)
      this.target.issues = []
      for (let val of issueMap.values()) {
        this.target.issues.push(val)
      }
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
    handleRemoveQr (file, fileList) {
      this.target.qr = []
    },
    onSuccessQr (response, file, fileList) {
      this.target.qr = [response.path]
    },
    onSubmit () {
      this.target.banners = [...this.bannerMap]
      if (this.target.qr[0].url) {
        this.target.qr = [this.target.qr.url]
      }

      this.demoService.update('/api/endpage/update/1?access-token=abc123_', this.target).then((resp) => {
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
  }
}
</script>
