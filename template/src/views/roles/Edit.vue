<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div>
    <v-app-bar flat>
      <v-btn
        icon
        light
        @click="backButton"
      >
        <v-icon color="#00a3ff">
          mdi-arrow-left
        </v-icon>
      </v-btn>
      <v-toolbar-title style="line-height: 1.3">
        Edit Roles
        <div
          v-if="!loadingData"
          style="font-size: 11pt"
        >
          {{ roles.id }}
        </div>
        <v-skeleton-loader
          v-else
          ref="skeleton"
          type="text"
          max-width="100%"
        />
      </v-toolbar-title>
    </v-app-bar>
    <v-container>
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
                v-model="roles.name"
                label="Hak Akses"
                outlined
                :rules="[rules.required]"
              />
              <v-autocomplete
                v-model="roles.permissions"
                :items="permissions"
                outlined
                chips
                deletable-chips
                label="Izin"
                multiple
                :rules="[rules.required]"
              />
              <v-btn
                color="green"
                large
                :dark="dataValidation"
                :disabled="!dataValidation"
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
    <update-dialog-confirm
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

export default {
  components: {
    'update-dialog-confirm': Dialog
  },
  props: {
    id: { type: [String, Number], required: true }
  },
  data () {
    return {
      loadingData: true,
      permissions: [],
      roles: {
        id: this.id,
        name: null,
        permissions: []
      },
      rules: {
        required: value => !!value || 'Tidak Boleh Kosong'
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
      return !!(this.roles.name)
    }
  },
  created () {
    this.getRolesById({ id: this.id })
      .then(data => {
        this.roles.name = data.role.name ?? ''
        this.roles.permissions = data.rolePermissions ?? []
        this.permissions = data.permissions ?? []
        this.loadingData = false
      })
      .catch((error) => {
        this.roles = { name: null, permissions: [] }
        console.log('Error : ' + error)
      })
  },
  methods: {
    ...mapActions(['getRolesById', 'updateRoles']),
    backButton () {
      this.$router.push({ name: 'roles' })
    },
    postUpdate () {
      this.dcProgress = true
      this.dcdisabledNegativeBtn = true
      this.dcdisabledPositiveBtn = true
      this.dcMessages = 'Sedang Menyimpan Roles...'

      this.updateRoles(this.roles).then((res) => {
        this.dcMessages = 'Berhasil Memperbarui Roles'
        this.dcProgress = false
        setTimeout(() => {
          this.showDC = false
          this.dcdisabledNegativeBtn = false
          this.dcdisabledPositiveBtn = false
          this.$router.push({ name: 'roles' })
          this.dcMessages = 'Simpan Perubahan Sekarang?'
        }, 1500)
      })
    }
  }
}
</script>

<style scoped>

</style>
