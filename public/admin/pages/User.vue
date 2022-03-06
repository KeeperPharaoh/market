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
            :items="users"
            :options.sync="options"
            :server-items-length="totalUsers"
            :loading="loading"
            :search="search"
            class="elevation-1"
        >
            <template #top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>Users</v-toolbar-title>
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
                                Создать User
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
                                                    v-model="editedItem.name"
                                                    style="padding: 2px;"
                                                    label="name"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.surname"
                                                    style="padding: 2px;"
                                                    label="surname"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.email"
                                                    style="padding: 2px;"
                                                    label="email"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.email_verified_at"
                                                    style="padding: 2px;"
                                                    label="email_verified_at"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.phone"
                                                    style="padding: 2px;"
                                                    label="phone"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.password"
                                                    style="padding: 2px;"
                                                    label="password"
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
                totalUsers: 0,
            users: [],
                search: '',
                field: 'id',
                loading: true,
                options: {},
            headers: [
                                    {
                    text: 'name',
                    value: 'name'
                },
                                    {
                    text: 'surname',
                    value: 'surname'
                },
                                    {
                    text: 'email',
                    value: 'email'
                },
                                    {
                    text: 'email_verified_at',
                    value: 'email_verified_at'
                },
                                    {
                    text: 'phone',
                    value: 'phone'
                },
                                    {
                    text: 'password',
                    value: 'password'
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
                                name: 0,
                                surname: 0,
                                email: 0,
                                email_verified_at: 0,
                                phone: 0,
                                password: 0,
                            },
            defaultItem: {
                                name: 0,
                                surname: 0,
                                email: 0,
                                email_verified_at: 0,
                                phone: 0,
                                password: 0,
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
                const test = await this.$axios.get(this.getBackend + 'users/paginate', { params })
                this.users = test.data.data
                this.totalUsers = test.data.total
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
                this.editedIndex = this.users.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            deleteItem (item) {
                this.editedIndex = this.users.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },
            deleteItemConfirm () {
                this.$axios.$delete(this.getBackend + 'users/' + this.users[this.editedIndex].id)
                    .then(() => {
                        this.password.splice(this.editedIndex, 1)
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
                                formData.append('name', this.editedItem.name)
                                formData.append('surname', this.editedItem.surname)
                                formData.append('email', this.editedItem.email)
                                formData.append('email_verified_at', this.editedItem.email_verified_at)
                                formData.append('phone', this.editedItem.phone)
                                formData.append('password', this.editedItem.password)
                
                if (this.editedIndex > -1) {
                    this.$axios.$post(this.getBackend + 'users')
                        .then(() => {
                            Object.assign(this.users[this.editedIndex], formData)
                            this.close()
                        })
                        .catch(() => {
                            this.snackbar.text = 'Возникла ошибка, попробуйте ещё раз'
                            this.snackbar.show = true
                            this.close()
                        })
                } else {
                    this.$axios.$put(this.getBackend + 'users/' + this.users[this.editedIndex].id)
                        .then(() => {
                            this.users.push(formData)
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
