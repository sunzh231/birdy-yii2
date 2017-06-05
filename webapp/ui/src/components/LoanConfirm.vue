<template >
  <div id="loan_confirm">
    <div class="page-wrap">
      <div class="page-header">
        <div class="title">
          {{target.name}}微信贷款信息核对确认书
        </div>
        <div class="datetime">
          {{formatDate}}
        </div>
      </div>
      <div class="page-content">
        <div class="content-group">
          <label>贷款申请人<span>:</span></label>
          <span class="text-control">{{target.name}}</span>
        </div>
        <div class="content-group">
          <label>贷款总金额<span>:</span></label>
          <span class="text-control">{{parseInt(target.loan_amount)}}万元</span>
        </div>
        <div class="content-group">
          <label>利息<span>:</span></label>
          <span class="text-control">{{target.loan_amount * 150}}元/月 月付</span>
        </div>
        <div class="content-group">
          <label>还款时间<span>:</span></label>
          <span class="text-control">每月{{new Date(target.created_at).getDate()}}日还上月利息，最后一个月支付本金</span>
        </div>
        <div class="content-group">
          <label>贷款时间<span>:</span></label>
          <span class="text-control">12个月</span>
        </div>
        <div class="content-group">
          <label>还款方式<span>:</span></label>
          <span class="text-control">将每月利息于指定时间前存入下方绑定的银行卡即可</span>
        </div>
        <div class="content-group">
          <label>身份证<span>:</span></label>
          <span class="text-control">
            <img width="100%" :src="target.id_card_front"/>
          </span>
        </div>
        <div class="content-group">
          <label>收款银行<span>:</span></label>
          <span class="text-control">
            <img width="100%" :src="target.bank_pic"/>
          </span>
        </div>
        <div class="content-group">
          <label>放款金额<span>:</span></label>
          <span class="text-control">{{parseInt(target.loan_amount)}}万元整</span>
        </div>
        <div class="content-group">
          <label>到账时间<span>:</span></label>
          <span class="text-control">2小时以内</span>
        </div>
        <div class="content-group">
          <label>手续费<span>:</span></label>
          <span class="text-control">500元人民币/一次性</span>
        </div>
        <div class="content-group help-tip">
          <label>办理截止时间<span>:</span></label>
          <span>18：00前，逾期系统将取消该贷款订单，请尽快点击办理</span>
        </div>
      </div>
      <box gap="10px 10px">
        <div @click="confirm">
          <x-button type="primary" class="confirm-btn">点击确定贷款</x-button>
        </div>
      </box>
    </div>
  </div>
</template>

<script>
import BirdyService from '../BirdyService'
import { XButton, Box, dateFormat } from 'vux'

export default {
  data () {
    return {
      birdyService: new BirdyService(this),
      content: {},
      target: {}
    }
  },
  created () {
    this.getData()
    this.pageInit()
    let url = location.href.split('#')[0]
    this.birdyService.get(`/api/wechat/config?url=${url}`).then((resp) => {
      this.config = resp
      this.$wechat.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: resp.appId, // 必填，公众号的唯一标识
        timestamp: resp.timestamp, // 必填，生成签名的时间戳
        nonceStr: resp.nonceStr, // 必填，生成签名的随机串
        signature: resp.signature,// 必填，签名，见附录1
        jsApiList: ['onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
      })

      this.$wechat.onMenuShareAppMessage({
        title: `${this.target.name}微信贷款信息核对确认书`, // 分享标题
        desc: '微信官方贷款在线申请', // 分享描述
        link: `http://loan.bailongsheng.cn/webapp/confirm/${this.$route.params.id}`, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://loan.bailongsheng.cn/upload/base/loan_logo.png', // 分享图标
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
  computed: {
    formatDate () {
      return dateFormat(new Date(this.target.created_at * 1000), 'YYYY-MM-DD')
    }
  },
  methods: {
    pageInit () {
      this.birdyService.get(`/api/content/1?access-token=abc123_`).then((resp) => {
        this.content = resp.content
      }).catch((resp) => {
        console.log(resp)
      }).finally(() => {

      })
    },
    getData () {
      this.birdyService.get(`/api/loan/view/${this.$route.params.id}?access-token=abc123_`).then((resp) => {
        this.target = resp
        // document.getElementsByTagName('title')[0].innerText = `${this.target.name}微信贷款信息核对确认书`
      }).catch((resp) => {

      }).finally(() => {

      })
    },
    confirm () {
      this.target.loan_status = 2
      this.birdyService.update(`/api/loan/update/${this.$route.params.id}?access-token=abc123_`).then((resp) => {
        window.location.href = this.content.link
      }).catch((resp) => {

      }).finally(() => {

      })
    }
  },
  components: {
    XButton, Box
  }
}
</script>

<style scoped lang="less">
@import '../assets/styles/variables.less';

#loan_confirm {
  padding: 10px;
  background: @dartWhite;
  .page-wrap {
    padding: 20px;
    border-radius: 5px;
    border: solid 1px @baseGray;
    background: @baseWhite;
    .page-header {
      margin-bottom: 20px;
      .datetime {
        font-size: 14px;
        color: @deepGray;
      }
    }
    .page-content {
      .content-group {
        .text-control {
          margin-left: 5px;
          color: @silver;
        }
      }
      .help-tip {
        color: @baseRed;
      }
    }
    .confirm-btn {
      margin-top: 10px;
      background: @baseBlue;
    }
  }
}
</style>
