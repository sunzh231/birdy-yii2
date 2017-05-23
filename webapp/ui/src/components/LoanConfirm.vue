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
        document.getElementsByTagName('title')[0].innerText = `${this.target.name}微信贷款信息核对确认书`
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
