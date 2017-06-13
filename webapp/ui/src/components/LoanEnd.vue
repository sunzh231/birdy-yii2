<template>
  <div id="loan_end">
    <div class="page-wrap">
      <div class="page-header">
        <div class="title">
          确认办理，最后一步

        </div>
        <div class="datetime">
          2017-05-22
        </div>
        <div class="pictures">
          <div class="pic-tilte">

          </div>
          <div class="pic">

          </div>
          <div class="pic-desc">

          </div>
        </div>
        <div class="issues">
          <div class="issue-title">

          </div>
          <ul>
            <li v-for="item in issues">
              <div class="question">
                <span></span>
                <span></span>
              </div>
              <div class="answer">

              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BirdyService from '../BirdyService'

export default {
  data () {
    return {
      birdyService: new BirdyService(this),
      issues: []
    }
  },
  methods: {
    init () {
      this.birdyService.get(`/api/loan/end?access-token=abc123_`).then((resp) => {

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
    }
  }
}
</style>
