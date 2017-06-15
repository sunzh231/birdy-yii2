<template>
  <div id="loan_end">
    <div class="page-wrap">
      <div class="page-header">
        <div class="title">
          {{ title }}
        </div>
        <div class="datetime">
          {{ now }}
        </div>
        <div class="pictures">
          <div class="pic">
            <div v-for="item in banners" class="pic-item">
              <div v-if="item.name == 'qr'" class="qr-text">
                {{ pic }}
              </div>
              <img :src="item.url"/>
            </div>
          </div>
        </div>
        <div class="issues">
          <div class="title-text">
            <div class="title-tip">
              常见问题
            </div>
            {{desc}}
          </div>
          <ul>
            <li v-for="(item, index) in issues">
              <div class="question">
                <span class="issue-no">{{ index + 1 }}</span>
                <span class="issue-title">{{ item.question }}</span>
              </div>
              <div class="answer">
                {{ item.answer }}
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { dateFormat } from 'vux'
import BirdyService from '../BirdyService'

export default {
  data () {
    return {
      birdyService: new BirdyService(this),
      now: dateFormat(new Date(), 'YYYY-MM-DD'),
      issues: [],
      banners: []
    }
  },
  created () {
    this.init()
  },
  methods: {
    init () {
      this.birdyService.get(`/api/endpage/view/1?access-token=abc123_`).then((resp) => {
        this.title = resp.content.title
        this.desc = resp.content.description
        this.pic = resp.content.pic
        this.banners = resp.pics
        this.issues = resp.issues
      }).catch((resp) => {
        console.log(resp)
      }).finally(() => {

      })
    }
  }
}
</script>

<style lang="less">
@import '../assets/styles/variables.less';

#loan_end {
  padding: 10px;
  background: @dartWhite;
  .page-wrap {
    padding: 20px;
    .page-header {
      margin-bottom: 20px;
      .datetime {
        font-size: 14px;
        color: @deepGray;
      }
      .pictures {
        .pic {
          img {
            width: 100%;
          }
          .qr-text {
            color: #e46c09;
          }
        }
      }
      .issues {
        .title-text {
          position: relative;
          width: 80%;
          margin: 10px auto;
          background: #fafaf0;
          padding: 20px 10px 10px 10px;
          border: solid 1px @baseGray;
          box-shadow: 5px 5px 5px #888888;
          .title-tip {
            position: absolute;
            top: -10px;
            left: 35%;
            background: #ff0000;
            padding: 2px 5px;
            box-shadow: 5px 5px 5px #888888;
          }
        }
        li {
          width: 100%;
        }
        .question {
          border-bottom: solid 2px @blue;
          padding-bottom: 3px;
          width: 100%;
          .issue-no {
            display: inline-block;
            width: 30px;
            height: 27px;
            background: @blue;
            text-align: center;
            padding-top: 3px;
            color: @baseWhite;
          }
          .issue-title {
            color: @deepGreen;
            display: inline-block;
            max-width: 80%;
            word-break: break-all;
            vertical-align: top;
          }
        }
      }
    }
  }
}
</style>
