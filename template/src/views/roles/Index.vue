<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div class="roles">
    <v-app-bar flat>
      <v-icon
        color="#00a3ff"
        class="mr-5 d-md-none"
        @click="$emit('toggle-drawer')"
        v-text="'mdi-menu'"
      />
      <v-toolbar-title class="ml-md-2">
        Roles
      </v-toolbar-title>

      <v-spacer />
      <v-btn
        title="Tambah Roles"
        icon
        @click="_add()"
      >
        <v-icon>mdi-plus</v-icon>
      </v-btn>
      <v-btn
        icon
        @click="toggleFp = !toggleFp"
      >
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
      <v-btn
        title="Perbarui Data"
        icon
        @click="_loadData(true)"
      >
        <v-icon>mdi-reload</v-icon>
      </v-btn>
    </v-app-bar>
    <v-container
      fluid
      style="padding: 0 1.5rem 0 1.5rem;"
    >
      <v-data-table
        :loading="isLoading"
        :headers="headerData"
        :search="searchQuery"
        :items="datas"
        :sort-by.sync="config.table.sortBy"
        :sort-desc.sync="config.table.sortDesc"
        :items-per-page="config.table.itemsPerPage"
        :page.sync="config.table.page"
        :server-items-length="serverLength"
        :options.sync="options"
        height="450pt"
        item-key="id"
        class="elevation-2"
        multi-sort
        hide-default-footer
        fixed-header
        @page-count="config.table.pageCount = $event"
        @pagination="pagination=$event"
      >
        <template #item.updated_at="{item}">
          {{ item.updated_at | moment('DD/MM/YYYY HH:mm') }}
        </template>
        <template #item.permission="{item}">
          <div style="padding: 5px">
            <span
              v-for="(izin,i) in item.permission"
              :key="i"
              class="d-inline-block"
              style="padding-right: 3px;padding-top: 3px"
            >
              <v-chip
                color="green"
                outlined
                v-text="izin"
              />
            </span>
          </div>
        </template>
        <template #item.aksi="{item}">
          <v-tooltip
            v-if="can(['role-edit'])"
            bottom
          >
            <template #activator="{ on, attrs }">
              <v-btn
                fab
                x-small
                class="mr-2"
                elevation="2"
                @click="_edit(item)"
                v-on="on"
              >
                <v-icon
                  color="blue"
                >
                  mdi-circle-edit-outline
                </v-icon>
              </v-btn>
            </template>
            <span>Ubah</span>
          </v-tooltip>
          <v-tooltip
            v-if="can(['role-delete'])"
            bottom
          >
            <template #activator="{ on, attrs }">
              <v-btn
                fab
                x-small
                class="mr-2"
                elevation="2"
                @click="_delete(item)"
                v-on="on"
              >
                <v-icon color="pink">
                  mdi-delete
                </v-icon>
              </v-btn>
            </template>
            <span>Hapus</span>
          </v-tooltip>
          <!--          <v-tooltip
            v-if="can(['admin'])"
            bottom
          >
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                v-bind="attrs"
                fab
                x-small
                class="mr-2"
                elevation="2"
                @click="_detail(item)"
                v-on="on"
              >
                <v-icon
                  color="green"
                >
                  mdi-text-long
                </v-icon>
              </v-btn>
            </template>
            <span>Detail</span>
          </v-tooltip>-->
        </template>
      </v-data-table>
      <div
        class="row align-center pb-3"
      >
        <div class="col-md-6 col-12 order-md-0 order-1 pt-0 pt-md-4">
          <v-data-footer
            class="float-left"
            :pagination="pagination"
            :prev-icon="null"
            :next-icon="null"
            :first-icon="null"
            :last-icon="null"
            :items-per-page-options="[10,15,50,100,-1]"
            :options.sync="options"
          />
        </div>
        <div class="col-md-6 col-12 order-md-1 order-0 mt-4 pb-0 pb-md-4">
          <v-pagination
            v-model="config.table.page"
            :length="config.table.pageCount"
            total-visible="7"
            circle
          />
        </div>
      </div>
    </v-container>
    <delete-dialog-confirm
      :show-dialog="showDC"
      :negative-button="dcNegativeBtn"
      :positive-button="dcPositiveBtn"
      :disabled-negative-btn="dcdisabledNegativeBtn"
      :disabled-positive-btn="dcdisabledPositiveBtn"
      :progress="dcProgress"
      :title="'Hapus'"
      :message="dcMessages"
    />
    <v-navigation-drawer
      v-model="toggleFp"
      fixed
      width="350"
      temporary
      right
    >
      <v-list-item class="grey lighten-4">
        <v-list-item-content>
          <v-list-item-title>
            <v-icon>mdi-filter-outline</v-icon> Filter
          </v-list-item-title>
        </v-list-item-content>
        <v-list-item-icon>
          <v-btn
            icon
            @click="toggleFp=!toggleFp"
          >
            <v-icon>mdi-chevron-right</v-icon>
          </v-btn>
        </v-list-item-icon>
      </v-list-item>

      <v-row class="px-4 py-4">
        <v-col
          cols="12"
        >
          <v-text-field
            v-model="searchQuery"
            placeholder="ketikkan sesuatu untuk mencari"
            label="Pencarian"
            light
            clearable
            hide-details
            outlined
            class="mb-4"
          />
        </v-col>
      </v-row>
      <div
        class="text-right px-4 py-4"
        style="position: absolute;bottom: 0;right: 0"
      >
        <v-btn
          v-show="searchQuery"
          text
          color="#00a3ff"
          @click="_clearFilter()"
        >
          Bersihkan filter
        </v-btn>
        <v-btn
          color="success"
          @click="_loadData(true)"
        >
          Terapkan
        </v-btn>
      </div>
    </v-navigation-drawer>
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import Dialog from '@/components/Dialog'

export default {
  name: 'Roles',
  components: {
    'delete-dialog-confirm': Dialog
  },
  data () {
    return {
      searchQuery: '',
      toggleFp: false,
      isLoading: true,
      datas: [],

      options: {},
      pagination: {},
      serverLength: 0,
      config: {
        table: {
          page: 1,
          pageCount: 0,
          sortBy: ['id'],
          sortDesc: [true],
          itemsPerPage: 10,
          itemKey: 'id'
        }
      },

      showDC: false,
      deleteId: '',
      dcMessages: '',
      dcProgress: false,
      dcdisabledNegativeBtn: false,
      dcdisabledPositiveBtn: false,
      dcNegativeBtn: () => { this.showDC = false },
      dcPositiveBtn: () => this._delete(true)
    }
  },
  computed: {
    headerData () {
      return [
        {
          text: 'ID',
          align: 'left',
          value: 'id'
        },
        { text: 'Hak Akses', value: 'name' },
        { text: 'Izin', value: 'permission', width: '30%' },
        { text: 'Updated', value: 'updated_at' },
        { text: '', value: 'aksi' }
      ]
    }
  },
  watch: {
    options (a, b) {
      this._loadData(true)
    }
  },
  mounted () {
    this._loadData(false) // loading data form server
  },
  methods: {
    ...mapActions(['getRoles', 'deleteRoles']),
    _detail (value) {
      this.$router.push({ name: 'roles_view', params: { id: value.id } })
    },
    _add () {
      this.$router.push({ name: 'roles_add' })
    },
    _edit (value) {
      this.$router.push({ name: 'roles_edit', params: { id: value.id } })
    },
    _delete (value) {
      if (value === true) {
        this.dcProgress = true
        this.dcdisabledNegativeBtn = true
        this.dcdisabledPositiveBtn = true
        this.dcMessages = 'Sedang menghapus roles'
        this.deleteRoles(this.deleteId).then(res => {
          this._loadData(true)
          this.dcProgress = false
          this.dcMessages = 'Berhasil Menghapus Roles'
          setTimeout(() => {
            this.deleteId = ''
            this.showDC = false
            this.dcdisabledNegativeBtn = false
            this.dcdisabledPositiveBtn = false
          }, 1500)
        }).catch(err => {
          console.log(err)
          this.dcdisabledNegativeBtn = false
          this.dcdisabledPositiveBtn = false
        })
      } else {
        this.deleteId = value.id
        this.dcMessages = `Hapus roles <span class="pink--text">#${this.deleteId}</span> ?`
        this.showDC = true
      }
    },
    _clearFilter () {
      this.searchQuery = null
      this._loadData(true)
    },
    _loadData (abort) {
      if (this.datas.length === 0 || abort) {
        this.isLoading = true
        this.getRoles({ search: this.searchQuery, ...this.options })
          .then((data) => {
            this.datas = data.items || []
            this.serverLength = data.total || 0
            this.isLoading = false
          })
      } else {
        this.isLoading = false
      }
    }
  }
}
</script>
<style v-slot:scoped>
.v-data-footer__icons-before,.v-data-footer__icons-after{
  display: none !important;
}
</style>
