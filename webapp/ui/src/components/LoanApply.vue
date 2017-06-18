<template>
  <div id="loan_apply">
    <swiper loop auto :list="demo06_list" :index="demo06_index" @on-index-change="demo06_onIndexChange"></swiper>
    <div class="divider-block">
      微信贷款申请官方平台说明
    </div>
    <div class="description">
      {{content.description}}
    </div>
    <div class="divider-block">
      请认真填写表单
    </div>
    <div class="form-wrap">
      <div class="form-group">
        <label class="label-control">姓名</label>
        <div class="content-control">
          <input type="text" v-model="target.name" placeholder="请填写您的真实姓名"/>
        </div>
      </div>

      <div class="form-group">
        <label class="label-control">手机号码</label>
        <div class="content-control">
          <input type="text" v-model="target.tel" placeholder="请填写您的手机号码"/>
        </div>
      </div>

      <div class="form-group">
        <label class="label-control">贷款金额</label>
        <div class="content-control">
          <select v-model="target.loan_amount">
            <option v-bind:value='0'>请选择您的贷款金额</option>
            <option v-bind:value='1'>1万</option>
            <option v-bind:value='2'>2万</option>
            <option v-bind:value='3'>3万</option>
            <option v-bind:value='4'>4万</option>
            <option v-bind:value='5'>5万</option>
            <option v-bind:value='6'>6万</option>
            <option v-bind:value='7'>7万</option>
            <option v-bind:value='8'>8万</option>
            <option v-bind:value='9'>9万</option>
            <option v-bind:value='10'>10万</option>
            <option v-bind:value='15'>15万</option>
            <option v-bind:value='20'>20万</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="label-control">职业</label>
        <div class="content-control">
          <input type="text" v-model="target.occupation" placeholder="请填写您的职业"/>
        </div>
      </div>

      <div class="form-group">
        <label class="label-control">家庭年收入</label>
        <div class="content-control">
          <select v-model="target.income">
            <option v-bind:value='0'>请选择您的家庭年收入</option>
            <option v-bind:value='5'>5万</option>
            <option v-bind:value='10'>10万</option>
            <option v-bind:value='15'>15万</option>
            <option v-bind:value='20'>20万</option>
            <option v-bind:value='30'>30万以上</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="label-control">上传身份证正面照片</label>
        <div class="content-control">
          <upload :fpath.sync="target.id_card_front" @update:fpath="val => target.id_card_front = val"></upload>
        </div>
      </div>

      <div class="form-group">
        <label class="label-control">上传银行卡照片</label>
        <div class="content-control">
          <upload :fpath.sync="target.bank_pic" @update:fpath="val => target.bank_pic = val"></upload>
        </div>
      </div>

    </div>
    <box gap="10px 10px">
      <div @click="apply">
        <x-button type="primary" class="apply-btn">提交微信贷款申请官方平台</x-button>
      </div>
    </box>
    <alert v-model="show" :title="result"> 恭喜您的贷款申请已成功提交 </alert>
    <toast v-model="showTip" type="text" :time="1600" is-show-mask :text="errorTip" :position="position"></toast>
  </div>
</template>

<script>
import BirdyService from '../BirdyService'
import { Alert, Toast, Swiper, XButton, Box } from 'vux'
import Upload from './Upload'

export default {
  components: {
    Alert, Toast, Swiper, XButton, Box, Upload
  },
  data () {
    return {
      birdyService: new BirdyService(this),
      position: 'default',
      showTip: false,
      show: false,
      result: '贷款申请提交结果',
      errorTip: '请完善表单内容',
      content: {},
      target: {
        loan_amount: 0,
        income: 0,
        id_card_front: '',
        bank_pic: ''
      },
      demo06_index: 0,
      demo06_list: []
    }
  },
  created () {
    this.pageInit()
    let url = location.href.split('#')[0]
    this.birdyService.get(`/api/wechat/config?url=${url}`).then((resp) => {
      this.config = resp
      this.$wechat.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: resp.appId, // 必填，公众号的唯一标识
        timestamp: resp.timestamp, // 必填，生成签名的时间戳
        nonceStr: resp.nonceStr, // 必填，生成签名的随机串
        signature: resp.signature,// 必填，签名，见附录1
        jsApiList: ['onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
      })

      this.$wechat.onMenuShareAppMessage({
        title: '微信在线贷款申请', // 分享标题
        desc: '微信1~20万元，无抵押信用贷款，最快30分钟审批', // 分享描述
        link: 'http://www.xindaifuwu.com/webapp', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://www.xindaifuwu.com/upload/base/loan_logo.png', // 分享图标
        type: '', // 分享类型,music、video或link，不填默认为link
        dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            // 用户确认分享后执行的回调函数
        },
        cancel: function () {
            // 用户取消分享后执行的回调函数
        }
      })
    }).catch((resp) => {
      console.log(resp)
    }).finally(() => {

    })
  },
  methods: {
    demo06_onIndexChange (index) {
      this.demo06_index = index
    },
    pageInit () {
      this.birdyService.get(`/api/content/1?access-token=abc123_`).then((resp) => {
        this.content = resp.content
        this.demo06_list = resp.banners.map((item, index) => ({
          url: '',
          img: item.url,
          title: ''
        }))
      }).catch((resp) => {
        console.log(resp)
      }).finally(() => {

      })
    },
    apply () {
      if (!this.target.name) {
        this.showTip = true
        this.errorTip = "请填写您的真实姓名"
        return false
      }
      if (!this.target.tel) {
        this.showTip = true
        this.errorTip = "请填写您的手机号码"
        return false
      } else if (!(/^1[34578]\d{9}$/.test(this.target.tel))) {
        this.showTip = true
        this.errorTip = "请输入正确手机号码"
        return false
      }
      if (this.target.loan_amount == 0) {
        this.showTip = true
        this.errorTip = "请选择贷款金额"
        return false
      }
      if (!this.target.occupation) {
        this.showTip = true
        this.errorTip = "请填写您的职业"
        return false
      }
      if (this.target.income == 0) {
        this.showTip = true
        this.errorTip = "请选择您的家庭年收入"
        return false
      }
      if (!this.target.id_card_front) {
        this.showTip = true
        this.errorTip = "请上传身份证正面照片"
        return false
      }
      if (!this.target.bank_pic) {
        this.showTip = true
        this.errorTip = "请上传银行卡照片"
        return false
      }

      this.birdyService.create(`/api/loan/create?access-token=abc123_`).then((resp) => {
        // this.$router.push({ path: `/confirm/${resp.id}` })
        this.show = true
        this.target = {
          loan_amount: 0,
          income: 0,
          id_card_front: '',
          bank_pic: ''
        }
      }).catch((resp) => {
        alert(resp)
        console.log(resp)
      }).finally(() => {

      })
    }
  }
}
</script>

<style scoped lang="less">
@import '../assets/styles/variables.less';

#loan_apply {
  background: @bgYellow;
  padding-bottom: 20px;
  .divider-block {
    background: @basePurple;
    height: 24px;
    padding: 8px 20px;
    color: @baseYellow;
    font-weight: lighter;
  }
  .description {
    min-height: 80px;
    padding: 10px 20px;
  }
  .form-wrap {
    padding: 10px;
    .form-group {
      margin: 15px 0px;
      .content-control {
        width: 100%;
        input, select {
          width: 96%;
          height: 35px;
          border: none;
          border-radius: 5px;
          padding-left: 4%;
        }
        select {
          width: 100%;
        }
      }
    }
  }
  .apply-btn {
    background: @basePurple;
    color: @baseYellow;
    font-weight: lighter;
  }
}
</style>
