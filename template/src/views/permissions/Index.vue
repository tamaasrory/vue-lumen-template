<!--
  - author : tama asrory
  - email : tamaasrory@gmail.com
  -->

<template>
  <div class="permissions">
    <v-app-bar flat>
      <v-icon
        color="#00a3ff"
        class="mr-5 d-md-none"
        @click="$emit('toggle-drawer')"
        v-text="'mdi-menu'"
      />
      <v-toolbar-title
        class="ml-md-2"
        v-text="`Permissions`"
      />
      <v-spacer />
      <v-btn
        v-if="can(['permissions-create'])"
        title="Tambah Permissions"
        icon
        @click="_add()"
      >
        <v-icon>mdi-plus</v-icon>
      </v-btn>
      <v-btn
        icon
        @click="booltmp.fp = !booltmp.fp"
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
        :loading="booltmp.loading"
        :headers="headerData"
        :search="filterQuery.search"
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
        <template #item.aksi="{item}">
          <v-tooltip
            v-if="can(['permissions-edit'])"
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
            v-if="can(['permissions-delete'])"
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
          <v-tooltip
            v-if="can(['permissions-list'])"
            bottom
          >
            <template #activator="{ on, attrs }">
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
          </v-tooltip>
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
    <delete-dialog
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
      v-model="booltmp.fp"
      fixed
      width="350"
      temporary
      right
    >
      <v-list-item class="grey lighten-4">
        <v-list-item-content>
          <v-list-item-title>
            <v-icon>mdi-magnify</v-icon> Pencarian
          </v-list-item-title>
        </v-list-item-content>
        <v-list-item-icon>
          <v-btn
            icon
            @click="booltmp.fp=!booltmp.fp"
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
            v-model="filterQuery.search"
            placeholder="ketikkan sesuatu"
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
          v-show="isClearSearch"
          text
          color="primary"
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
import { isEmpty } from '@/plugins/supports'

export default {
  name: 'Permissions',
  components: {
    'delete-dialog': Dialog
  },
  data () {
    return {
      searchQuery: '',
      filterQuery: {
        search: null
      },
      booltmp: {
        fp: false,
        ft: false,
        loading: true
      },
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
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Guard Name', value: 'guard_name' },
        // { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: '', value: 'aksi' }
      ]
    },
    isClearSearch () {
      for (const key in this.filterQuery) {
        if (!isEmpty(this.filterQuery[key])) {
          return true
        }
      }
      return false
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
    ...mapActions(['getAllPermissions', 'deletePermissions']),
    _detail (value) {
      this.$router.push({ name: 'permissions_view', params: { id: value.id } })
    },
    _add () {
      this.$router.push({ name: 'permissions_add' })
    },
    _edit (value) {
      this.$router.push({ name: 'permissions_edit', params: { id: value.id } })
    },
    _delete (value) {
      if (value === true) {
        this.dcProgress = true
        this.dcdisabledNegativeBtn = true
        this.dcdisabledPositiveBtn = true
        this.dcMessages = 'Sedang Menghapus Permissions'
        this.deletePermissions(this.deleteId).then(res => {
          this._loadData(true)
          this.dcProgress = false
          this.dcMessages = res.msg
          setTimeout(() => {
            this.deleteId = ''
            this.showDC = false
            this.dcdisabledNegativeBtn = false
            this.dcdisabledPositiveBtn = false
          }, 1500)
        }).catch(err => {
          console.log(err)
          this.dcMessages = err.msg
          this.dcdisabledNegativeBtn = false
          this.dcdisabledPositiveBtn = false
        })
      } else {
        this.deleteId = value.id
        this.dcMessages = `Hapus Permissions <span class="pink--text">#${this.deleteId}</span> ?`
        this.showDC = true
      }
    },
    _clearFilter () {
      Object.keys(this.filterQuery).forEach(v => {
        this.filterQuery[v] = null
      })
      this._loadData(true)
    },
    _loadData (abort) {
      if (this.datas.length === 0 || abort) {
        this.booltmp.loading = true
        this.getAllPermissions({ ...this.options, ...this.filterQuery })
          .then((data) => {
            this.datas = data.items || []
            this.serverLength = data.total || 0
            this.booltmp.loading = false
          })
      } else {
        this.booltmp.loading = false
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
