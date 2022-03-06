<template>
    <v-card>
        <v-card-title>
            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            />
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="products"
            :options.sync="options"
            :server-items-length="totalProducts"
            :loading="loading"
            :search="search"
            class="elevation-1"
        >
            <template #top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>Products</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    />
                    <v-spacer />
                    <v-dialog
                        v-model="dialog"
                        max-width="500px"
                    >
                        <template #activator="{ on, attrs }">
                            <v-btn
                                color="primary"
                                dark
                                class="mb-2"
                                v-bind="attrs"
                                v-on="on"
                            >
                                Создать Product
                            </v-btn>
                        </template>
                        <v-card>
                            <v-card-title>
                                <span class="text-h5">{{ formTitle }}</span>
                            </v-card-title>
                            <v-card-text>
                                <v-container>
                                    <div style="display: flex; flex-wrap: wrap">
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.category_id"
                                                    style="padding: 2px;"
                                                    label="category_id"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.title"
                                                    style="padding: 2px;"
                                                    label="title"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.description"
                                                    style="padding: 2px;"
                                                    label="description"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.price"
                                                    style="padding: 2px;"
                                                    label="price"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.old_price"
                                                    style="padding: 2px;"
                                                    label="old_price"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.is_hit"
                                                    style="padding: 2px;"
                                                    label="is_hit"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.is_latest"
                                                    style="padding: 2px;"
                                                    label="is_latest"
                                                />
                                            </div>
                                                                            </div>
                                </v-container>
                            </v-card-text>

                            <v-card-actions>
                                <v-spacer />
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="close"
                                >
                                    Cancel
                                </v-btn>
                                <v-btn
                                    color="blue darken-1"
                                    text
                                    @click="save"
                                >
                                    Save
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h5">
                                Are you sure you want to delete this item?
                            </v-card-title>
                            <v-card-actions>
                                <v-spacer />
                                <v-btn color="blue darken-1" text @click="closeDelete">
                                    Cancel
                                </v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm">
                                    OK
                                </v-btn>
                                <v-spacer />
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template #item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
            </template>
            <template #no-data>
                <v-btn
                    color="primary"
                    @click="initialize"
                >
                    Reset
                </v-btn>
            </template>
        </v-data-table>
        <v-snackbar
            v-model="snackbar.show"
            :timeout="snackbar.timeout"
        >
            {{ snackbar.text }}

            <template #action="{ attrs }">
                <v-btn
                    color="green"
                    text
                    v-bind="attrs"
                    @click="snackbar.show = false"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </v-card>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        data () {
            return {
                totalProducts: 0,
            products: [],
                search: '',
                field: 'id',
                loading: true,
                options: {},
            headers: [
                                    {
                    text: 'category_id',
                    value: 'category_id'
                },
                                    {
                    text: 'title',
                    value: 'title'
                },
                                    {
                    text: 'description',
                    value: 'description'
                },
                                    {
                    text: 'price',
                    value: 'price'
                },
                                    {
                    text: 'old_price',
                    value: 'old_price'
                },
                                    {
                    text: 'is_hit',
                    value: 'is_hit'
                },
                                    {
                    text: 'is_latest',
                    value: 'is_latest'
                },
                                    {
                    text: 'Actions',
                    value: 'actions',
                    sortable: false
                }
            ],
                dialog: false,
                dialogDelete: false,
                editedIndex: -1,
                editedItem: {
                                category_id: 0,
                                title: 0,
                                description: 0,
                                price: 0,
                                old_price: 0,
                                is_hit: 0,
                                is_latest: 0,
                            },
            defaultItem: {
                                category_id: 0,
                                title: 0,
                                description: 0,
                                price: 0,
                                old_price: 0,
                                is_hit: 0,
                                is_latest: 0,
                            },
            snackbar: {
                show: false,
                    text: '',
                    timeout: 2000
            }
        }
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            },
            ...mapGetters('endpoints', [
                'getBackend'
            ])
        },
        watch: {
            options: {
                handler () {
                    this.getDataFromApi()
                },
                deep: true
            },
            dialog (val) {
                val || this.close()
            },
            dialogDelete (val) {
                val || this.closeDelete()
            },
            search (val) {
                this.debounce(this.getDataFromApi(), 500)
            }
        },
        mounted () {
            this.getDataFromApi()
        },
        methods: {
            async getDataFromApi () {
                this.loading = true
                const params = this.options
                params.search = this.search
                params.field = this.field
                const test = await this.$axios.get(this.getBackend + 'products/paginate', { params })
                this.products = test.data.data
                this.totalProducts = test.data.total
                this.loading = false
            },
            debounce (func, wait, immediate) {
                let timeout
                return function () {
                    const context = this
                    const args = arguments
                    const later = function () {
                        timeout = null
                        if (!immediate) { func.apply(context, args) }
                    }
                    const callNow = immediate && !timeout
                    clearTimeout(timeout)
                    timeout = setTimeout(later, wait)
                    if (callNow) { func.apply(context, args) }
                }
            },
            editItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            deleteItem (item) {
                this.editedIndex = this.products.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },
            deleteItemConfirm () {
                this.$axios.$delete(this.getBackend + 'products/' + this.products[this.editedIndex].id)
                    .then(() => {
                        this.is_latest.splice(this.editedIndex, 1)
                        this.closeDelete()
                    })
                    .catch(() => {
                        this.snackbar.text = 'Возникла ошибка, попробуйте ещё раз'
                        this.snackbar.show = true
                        this.closeDelete()
                    })
            },
            close () {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },
            closeDelete () {
                this.dialogDelete = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },
            async save () {
                const formData = new FormData()
                                formData.append('category_id', this.editedItem.category_id)
                                formData.append('title', this.editedItem.title)
                                formData.append('description', this.editedItem.description)
                                formData.append('price', this.editedItem.price)
                                formData.append('old_price', this.editedItem.old_price)
                                formData.append('is_hit', this.editedItem.is_hit)
                                formData.append('is_latest', this.editedItem.is_latest)
                
                if (this.editedIndex > -1) {
                    this.$axios.$post(this.getBackend + 'products')
                        .then(() => {
                            Object.assign(this.products[this.editedIndex], formData)
                            this.close()
                        })
                        .catch(() => {
                            this.snackbar.text = 'Возникла ошибка, попробуйте ещё раз'
                            this.snackbar.show = true
                            this.close()
                        })
                } else {
                    this.$axios.$put(this.getBackend + 'products/' + this.products[this.editedIndex].id)
                        .then(() => {
                            this.products.push(formData)
                            this.close()
                        })
                        .catch(() => {
                            this.snackbar.text = 'Возникла ошибка, попробуйте ещё раз'
                            this.snackbar.show = true
                            this.close()
                        })
                }
            }
        }
    }
</script>
