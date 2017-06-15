<template>
  <div class="vue-upload-img-multiple">
    <div>
      <input class="upload-btn" type="file" value="12" @change="onFileChange">
    </div>
    <div v-if="images.length >0">
      <ul>
        <li v-for="image in images">
          <img width="100%" :src="image" />
        </li>
      </ul>
      <button @click="removeImage">移除</button>
      <!-- <button @click='addPic'>上传</button> -->
    </div>
  </div>
</template>

<script>
import lrz from 'lrz'

export default {
  props: {
    fpath: {
      type: String
    }
  },
  data: function () {
    return {
      images: []
    }
  },
  methods: {
    addPic () {
      this.fileUpload()
    },
    onFileChange (e) {
      let vm = this
      let files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      lrz(files[0])
        .then(function (rst) {
          vm.createImage(files)
          console.log(rst)
          rst.formData.append('fileLen', rst.fileLen)
          // rst.formData.append('xxx', '我是其他参数');
          // xhr.send(rst.formData);
          vm.fileUpload(rst)
        })
        .then(function (rst) {
          console.log(rst)
          return rst;
        })
        .catch(function (err) {
          alert(err);
        })
        .always(function () {
          // 不管是成功失败，这里都会执行
        });
    },
    createImage (file) {
      this.images = []
      let vm = this
      let reader = null
      let leng = file.length
      for (let i = 0; i < leng; i++) {
        reader = new window.FileReader()
        reader.readAsDataURL(file[i])
        reader.onload = function (e) {
          vm.images.push(e.target.result)
        }
      }
    },
    removeImage: function (e) {
      this.images = []
      this.$emit('update:fpath', '')
    },
    fileUpload (rst) {
      // if (this.images.length > 0) {
      //   let formData = new FormData()
      //   formData.append('top', this.images[0])
      //   formData.append("file", new Blob(["Hello World!"], {type:"text/plain"}))
      // }
      this.$http.post('/api/upload/picture', rst.formData).then(function(resp) {
        // this.filePath = resp.data
        let url = resp.data.data
        this.$emit('update:fpath', url)
      }, function(err) {
        console.log(err)
      })
    }
  }
}
</script>

<style lang="less">
@import '../assets/styles/variables.less';

ul {
  list-style-type: none;
  padding: 0;
  li {
    display: inline-block;
    margin: 0 10px;
  }
}
.upload-btn {
  width: 64px;
  height: 30px;
  border: solid 1px @baseBlue;
  /*background: @baseBlue;*/
  color: @baseWhite !important;
  border-radius: 3px;
  line-height: 30px;
}
</style>
