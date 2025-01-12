<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div>
    <v-app-bar flat>
      <v-btn
        icon
        dark
        @click="backButton"
      >
        <v-icon color="#00a3ff">
          mdi-arrow-left
        </v-icon>
      </v-btn>
      <v-toolbar-title class="ml-md-2">
        Edit Permissions
        <div
          v-if="!loadingData"
          style="font-size: 11pt"
        >
          {{ datas.id }}
        </div>
        <v-skeleton-loader
          v-else
          ref="skeleton"
          type="text"
          max-width="100%"
        />
      </v-toolbar-title>
    </v-app-bar>
    <v-container
      fluid
      style="padding: 0 1.5rem 0 1.5rem;"
    >
      <v-row class="py-0 py-md-3">
        <v-col
          cols="12"
          md="6"
          class="mx-auto"
        >
          <v-row>
            <v-col
              cols="12"
              md="12"
            >
              <v-text-field
                v-model="datas.name"
                label="Name"
                outlined
                :rules="[rules.required]"
              />
              <v-text-field
                v-model="datas.guard_name"
                label="Guard Name"
                outlined
                :rules="[rules.required]"
              />
              <v-btn
                color="green"
                large
                :dark="!dataValidation"
                :disabled="dataValidation"
                @click="showDC = true"
              >
                <v-icon color="white">
                  mdi-check
                </v-icon>
                SIMPAN
              </v-btn>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
    <update-dialog
      :show-dialog="showDC"
      :negative-button="dcNegativeBtn"
      :positive-button="dcPositiveBtn"
      :disabled-negative-btn="dcdisabledNegativeBtn"
      :disabled-positive-btn="dcdisabledPositiveBtn"
      :title="'Perbarui'"
      :message="dcMessages"
      :progress="dcProgress"
    />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import Dialog from '@/components/Dialog'
import { inputValidator, isEmpty } from '@/plugins/supports'

export default {
  components: {
    'update-dialog': Dialog
  },
  props: {
    id: { type: [String, Number], required: true }
  },
  data () {
    return {
      loadingData: true,
      datas: {
        name: null,
        guard_name: null
      },
      items: {
        // {{item_cols}}
      },
      dataTypes: {
        name: 'string',
        guard_name: 'string'
      },
      schema: {
        name: 'required',
        guard_name: 'required'
      },
      rules: {
        required: v => {
          v = isEmpty(v)
          return !v || 'Tidak Boleh Kosong'
        }
      },
      showDC: false,
      dcMessages: 'Simpan Perubahan Sekarang?',
      dcProgress: false,
      dcdisabledNegativeBtn: false,
      dcdisabledPositiveBtn: false,
      dcNegativeBtn: () => { this.showDC = false },
      dcPositiveBtn: () => this.postUpdate()
    }
  },
  computed: {
    dataValidation () {
      return inputValidator(this.schema, this.rules, this.datas)
    }
  },
  created () {
    this.editPermissions({ id: this.id })
      .then(data => {
        this.datas = isEmpty(data, {})
        this.datas.detail = isEmpty(data.detail, {})
        this.loadingData = false
      })
      .catch((error) => {
        this.datas = {}
        this.loadingData = false
        console.log('Error : ' + error)
      })
  },
  methods: {
    ...mapActions(['editPermissions', 'updatePermissions']),
    backButton () {
      this.$router.push({ name: 'permissions' })
    },
    postUpdate () {
      /* Initialize the form data */
      const formData = new FormData()

      /* Add the form data we need to submit */
      Object.keys(this.datas).forEach(d => {
        const tmp = this.datas[d]
        if (this.dataTypes[d] !== 'json') {
          formData.append(d, tmp)
        } else {
          formData.append(d,
            new Blob([JSON.stringify(tmp)],
              { type: 'application/json' })
          )
        }
      })

      this.dcProgress = true
      this.dcdisabledNegativeBtn = true
      this.dcdisabledPositiveBtn = true
      this.dcMessages = 'Sedang Menyimpan Permissions...'

      this.updatePermissions(formData).then((res) => {
        this.dcMessages = res.msg
        this.dcProgress = false
        setTimeout(() => {
          this.showDC = false
          this.dcdisabledNegativeBtn = false
          this.dcdisabledPositiveBtn = false
          this.$router.push({ name: 'permissions' })
          this.dcMessages = 'Simpan Perubahan Sekarang?'
        }, 1500)
      })
    }
  }
}
</script>

<style scoped>

</style>
