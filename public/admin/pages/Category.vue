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
            :items="categories"
            :options.sync="options"
            :server-items-length="totalCategories"
            :loading="loading"
            :search="search"
            class="elevation-1"
        >
            <template #top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>Categories</v-toolbar-title>
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
                                Создать Category
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
                                                    v-model="editedItem.parent_id"
                                                    style="padding: 2px;"
                                                    label="parent_id"
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
                                                    v-model="editedItem.image"
                                                    style="padding: 2px;"
                                                    label="image"
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
                totalCategories: 0,
            categories: [],
                search: '',
                field: 'id',
                loading: true,
                options: {},
            headers: [
                                    {
                    text: 'parent_id',
                    value: 'parent_id'
                },
                                    {
                    text: 'title',
                    value: 'title'
                },
                                    {
                    text: 'image',
                    value: 'image'
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
                                parent_id: 0,
                                title: 0,
                                image: 0,
                            },
            defaultItem: {
                                parent_id: 0,
                                title: 0,
                                image: 0,
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
                const test = await this.$axios.get(this.getBackend + 'categories/paginate', { params })
                this.categories = test.data.data
                this.totalCategories = test.data.total
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
                this.editedIndex = this.categories.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            deleteItem (item) {
                this.editedIndex = this.categories.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },
            deleteItemConfirm () {
                this.$axios.$delete(this.getBackend + 'categories/' + this.categories[this.editedIndex].id)
                    .then(() => {
                        this.image.splice(this.editedIndex, 1)
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
                                formData.append('parent_id', this.editedItem.parent_id)
                                formData.append('title', this.editedItem.title)
                                formData.append('image', this.editedItem.image)
                
                if (this.editedIndex > -1) {
                    this.$axios.$post(this.getBackend + 'categories')
                        .then(() => {
                            Object.assign(this.categories[this.editedIndex], formData)
                            this.close()
                        })
                        .catch(() => {
                            this.snackbar.text = 'Возникла ошибка, попробуйте ещё раз'
                            this.snackbar.show = true
                            this.close()
                        })
                } else {
                    this.$axios.$put(this.getBackend + 'categories/' + this.categories[this.editedIndex].id)
                        .then(() => {
                            this.categories.push(formData)
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
