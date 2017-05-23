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
      var files = e.target.files || e.dataTransfer.files
      if (!files.length) return
      this.createImage(files)
    },
    createImage (file) {
      this.images = []
      var vm = this
      var reader = null
      var leng = file.length
      for (var i = 0; i < leng; i++) {
        reader = new window.FileReader()
        reader.readAsDataURL(file[i])
        reader.onload = function (e) {
          vm.images.push(e.target.result)
          vm.fileUpload()
        }
      }
    },
    removeImage: function (e) {
      this.images = []
      this.$emit('update:fpath', '')
    },
    // delImage: function (index) {
    //   this.images.shift(index)
    // },
    fileUpload () {
      if (this.images.length > 0) {
        let formData = new FormData()
        formData.append('top', this.images[0])
        formData.append("file", new Blob(["Hello World!"], {type:"text/plain"}))
        this.$http.post('/api/upload/picture', formData).then(function(resp) {
          // this.filePath = resp.data
          let url = resp.data.data
          this.$emit('update:fpath', url)
        }, function(err) {
          console.log(err)
        })
      }
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
