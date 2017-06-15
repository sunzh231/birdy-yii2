<template>
  <div id="demo-editor">
    <el-dialog title="收货地址" v-model="dialogVisible" v-on:close="handleClose()">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px">
        <el-form-item label="活动名称" prop="name">
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
        <el-form-item label="活动区域" prop="region">
          <el-select v-model="ruleForm.region" placeholder="请选择活动区域">
            <el-option label="区域一" value="shanghai"></el-option>
            <el-option label="区域二" value="beijing"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="活动时间" required>
          <el-col :span="11">
            <el-form-item prop="date1">
              <el-date-picker type="date" placeholder="选择日期" v-model="ruleForm.date1" style="width: 100%;"></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col class="line" :span="2">-</el-col>
          <el-col :span="11">
            <el-form-item prop="date2">
              <el-time-picker type="fixed-time" placeholder="选择时间" v-model="ruleForm.date2" style="width: 100%;"></el-time-picker>
            </el-form-item>
          </el-col>
        </el-form-item>
        <el-form-item label="即时配送">
          <el-switch on-text="" off-text="" v-model="ruleForm.delivery"></el-switch>
        </el-form-item>
        <el-form-item label="活动性质" prop="type">
          <el-checkbox-group v-model="ruleForm.type">
            <el-checkbox label="美食/餐厅线上活动" name="type"></el-checkbox>
            <el-checkbox label="地推活动" name="type"></el-checkbox>
            <el-checkbox label="线下主题活动" name="type"></el-checkbox>
            <el-checkbox label="单纯品牌曝光" name="type"></el-checkbox>
          </el-checkbox-group>
        </el-form-item>
        <el-form-item label="特殊资源" prop="resource">
          <el-radio-group v-model="ruleForm.resource">
            <el-radio label="线上品牌商赞助"></el-radio>
            <el-radio label="线下场地免费"></el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="活动形式" prop="desc">
          <el-input type="textarea" v-model="ruleForm.desc"></el-input>
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
import DemoStore from '../DemoStore'
import DemoService from '../DemoService'

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
    return {
      target: this.tableRow,
      btnLoading: false,
      demoService: new DemoService(this),
      ruleForm: {
        name: '',
        region: '',
        date1: '',
        date2: '',
        delivery: false,
        type: [],
        resource: '',
        desc: ''
      },
      rules: {
        name: [
          { required: true, message: '请输入活动名称', trigger: 'blur' },
          { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
        ],
        region: [
          { required: true, message: '请选择活动区域', trigger: 'change' }
        ],
        date1: [
          { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
        ],
        date2: [
          { type: 'date', required: true, message: '请选择时间', trigger: 'change' }
        ],
        type: [
          { type: 'array', required: true, message: '请至少选择一个活动性质', trigger: 'change' }
        ],
        resource: [
          { required: true, message: '请选择活动资源', trigger: 'change' }
        ],
        desc: [
          { required: true, message: '请填写活动形式', trigger: 'blur' }
        ]
      }
    };
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
            this.updateDemo()
          } else {
            this.createDemo()
          }
        } else {
          return false;
        }
      });
    },
    createDemo () {
      this.demoService.create('/admin/demo/save').then((resp) => {
        if (resp.success) {
          this.$emit('closeDialog')
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
    updateDemo () {
      this.demoService.update('/admin/demo/update').then((resp) => {
        if (resp.success) {
          this.$emit('closeDialog')
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
