<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div class="image-uploader">
    <div
      v-if="showPreviewImage"
      class="display-image-preview-container"
    >
      <div class="display-image-preview">
        <img
          :src="previewImage?previewImage:''"
          alt=""
        >
        <span
          class="btn-close-image-preview"
          @click="showPreviewImage=false"
        >
          <i class="mdi mdi-close" />
        </span>
      </div>
    </div>
    <Viewer
      :images="previewImages"
      style="width: 100%"
    >
      <ul class="image-upload-preview-container">
        <li
          v-for="(image,index) in previewImages"
          :key="index"
        >
          <v-row>
            <v-col
              cols="4"
              md="4"
            >
              <div class="image-upload-preview-list">
                <img
                  class="image-upload-preview"
                  alt=""
                  :src="image?image:''"
                >
                <i
                  v-if="canRemove"
                  class="mdi mdi-delete remove-preview-icon"
                  @click="()=>removeImageData?removeImageData(index):defaultRemoveImageData(index)"
                />
              </div>
            </v-col>
            <v-col
              cols="8"
              md="8"
            >
              <v-text-field
                v-model="imageData[index].keterangan"
                :disabled="!canRemove"
                label="Keterangan"
                hide-details
              />
            </v-col>
          </v-row>
        </li>
        <li
          v-for="shimmer in loading"
          :key="`shimmer-${shimmer}`"
          class="image-upload-preview-list"
        >
          <div class="shimmer image-upload-preview">
            <i class="mdi mdi-image add-uploader-icon" />
          </div>
        </li>
        <li
          v-show="showAddImage"
        >
          <v-row>
            <v-col
              cols="4"
              md="4"
            >
              <div class="upload-image-placeholder">
                <i class="mdi mdi-camera-plus add-uploader-icon" />
                <input
                  type="file"
                  class="add_file"
                  @change="(v)=>onChangeImage?onChangeImage(v):defaultOnChangeImage(v)"
                >
              </div>
            </v-col>
          </v-row>
        </li>
      </ul>
    </Viewer>
  </div>
</template>

<script>

import { imgUrlToBlob } from '@/plugins/supports'
import 'viewerjs/dist/viewer.css'
import Viewer from 'v-viewer/src/component.vue'

export default {
  name: 'ImageUploaderAdv',
  components: {
    Viewer
  },
  props: {
    syncValue: {
      type: Function,
      default: (v) => v,
      required: true
    },
    loading: {
      type: [Number, Boolean],
      default: 0,
      required: false
    },
    vModel: {
      type: Array,
      // eslint-disable-next-line vue/require-valid-default-prop
      default: [],
      required: true
    },
    removeImageData: {
      type: [Function, Boolean],
      default: false,
      reuired: false
    },
    canRemove: {
      type: [Function, Boolean],
      default: false,
      reuired: false
    },
    onChangeImage: {
      type: [Function, Boolean],
      default: false,
      required: false
    },
    compressImage: {
      type: Function,
      default: (imageData) => {
        return imageData
      }
    },
    openPreviewImage: {
      type: [Function, Boolean],
      default: false,
      required: false
    },
    maxImage: {
      type: Number,
      default: 3,
      required: false
    }
  },
  data () {
    return {
      previewImages: [],
      previewImage: null,
      showPreviewImage: false,
      imageData: [],
      showAddImage: true
    }
  },
  watch: {
    imageData: {
      handler (newVal, oldVal) {
        this.syncValue(this.imageData)
        this.showAddImage = !(this.imageData.length === this.maxImage)
      },
      deep: true
    },
    vModel (n, o) {
      this.previewImages = []
      this.vModel.map(data => {
        if (typeof data.dataBlob === 'string') {
          imgUrlToBlob(data.dataBlob, (res) => {
            this.defaultCompress(res).then(resBlob => {
              data.dataBlob = res
              this.previewImages.push(URL.createObjectURL(data.dataBlob))
            })
          })
        } else {
          this.previewImages.push(URL.createObjectURL(data.dataBlob))
        }
      })
      this.imageData = this.vModel
      // console.log(this.imageData)
    }
  },
  methods: {
    async defaultOnChangeImage (e) {
      let tmp = e.target.files[0]
      tmp = await this.compressImage(tmp)
      console.log('compressed => ', tmp)
      this.imageData.push({ dataBlob: tmp, keterangan: null, flag: 0 })
      tmp = URL.createObjectURL(tmp)
      this.previewImages.push(tmp)
    },
    async defaultCompress (tmp) {
      tmp = await this.compressImage(tmp)
      return tmp
    },
    defaultOpenPreviewImage (image) {
      this.previewImage = image
      this.showPreviewImage = true
    },
    defaultRemoveImageData (index) {
      let pre = []
      let img = []
      this.previewImages.map((data, i) => {
        if (i !== index) {
          pre.push(data)
          img.push(this.imageData[i])
        }
      })
      this.previewImages = pre
      this.imageData = img
    }
  }
}
</script>

<style scoped>
  .upload-image-placeholder {
    border: 2px dashed #d9d9d9;
    border-radius: 7pt;
    position: relative;
    /*float: left;*/
    overflow: hidden;
    min-width: 80pt;
    height: 60pt;
  }

  .add-uploader-icon {
    color: #8c939d;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 28pt;
    position: absolute;
  }

  .upload-image-placeholder:hover > .add-uploader-icon {
    font-size: 35pt;
    color: #00a8ff;
  }

  .add_file {
    opacity: 0;
    cursor: pointer;
    position: absolute;
    width: 100%;
    height: 100%;
  }

  .image-upload-preview-container {
    list-style: none;
    padding-left: 0 !important;
    width: 100%;
  }

  .image-upload-preview-list {
    /*float: left;*/
    width: 100%;
    height: 60pt;
    margin: 0 7pt 7pt 0;
    position: relative;
  }

  .image-upload-preview {
    width: 100%;
    height: 100%;
    border-radius: 7pt;
    cursor: pointer;
  }

  .image-upload-preview-list:hover {
    transform: scale(1.03);
  }

  .remove-preview-icon {
    position: absolute;
    cursor: pointer;
    border-top-left-radius: 7pt;
    border-bottom-right-radius: 7pt;
    transform: translateX(-100%) translateY(-100%);
    top: 100%;
    left: 100%;
    padding: 3pt;
    background-color: rgba(0, 0, 0, 0.3);
    color: white;
    font-size: 18pt;
  }

  .remove-preview-icon:hover {
    font-size: 24pt;
  }

  .display-image-preview-container {
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 100;
    width: 100%;
    height: 100%;
  }

  .display-image-preview {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
  }

  .display-image-preview > img {
    width: 100%;
  }

  .btn-close-image-preview {
    cursor: pointer;
    position: absolute;
    top: 2%;
    right: 3%;
    align-items: center;
    display: flex !important;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    color: #fff;
    font-size: 16pt;
    width: 28pt;
    height: 28pt;
    /*transform: translate(50%,-50%);*/
  }

  .image-uploader {
    position: relative;
    display: flex;
    margin: 20px 0px;
    line-height: 1 !important;
  }

  .shimmer {
    background: #f5f5f5;
    background-image: linear-gradient(to right, #f5f5f5 0%, #edeef1 25%, #edeef1 50%, #f5f5f5 100%);
    background-repeat: no-repeat;
    background-size: 100%;
    display: inline-block;
    position: relative;

    -webkit-animation-duration: 1.5s;
    -webkit-animation-fill-mode: forwards;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-name: placeholderShimmer;
    -webkit-animation-timing-function: linear;
  }

  .lines-container-shimmer {
    display: inline-flex;
    flex-direction: column;
    margin-left: 25px;
    margin-top: 15px;
    vertical-align: top;
  }

  @-webkit-keyframes placeholderShimmer {
    0% {
      background-position: -468px 0;
    }

    100% {
      background-position: 468px 0;
    }
  }

</style>
