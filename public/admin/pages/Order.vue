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
            :items="orders"
            :options.sync="options"
            :server-items-length="totalOrders"
            :loading="loading"
            :search="search"
            class="elevation-1"
        >
            <template #top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>Orders</v-toolbar-title>
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
                                Создать Order
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
                                                    v-model="editedItem.user_id"
                                                    style="padding: 2px;"
                                                    label="user_id"
                                                />
                                            </div>
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
                                                    v-model="editedItem.phone"
                                                    style="padding: 2px;"
                                                    label="phone"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.comment"
                                                    style="padding: 2px;"
                                                    label="comment"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.street"
                                                    style="padding: 2px;"
                                                    label="street"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.home"
                                                    style="padding: 2px;"
                                                    label="home"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.apartment"
                                                    style="padding: 2px;"
                                                    label="apartment"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.entrance"
                                                    style="padding: 2px;"
                                                    label="entrance"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.floor"
                                                    style="padding: 2px;"
                                                    label="floor"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.office"
                                                    style="padding: 2px;"
                                                    label="office"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.status"
                                                    style="padding: 2px;"
                                                    label="status"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.payment_id"
                                                    style="padding: 2px;"
                                                    label="payment_id"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.payment_status"
                                                    style="padding: 2px;"
                                                    label="payment_status"
                                                />
                                            </div>
                                                                                    <div>
                                                <v-text-field
                                                    v-model="editedItem.sum"
                                                    style="padding: 2px;"
                                                    label="sum"
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
                totalOrders: 0,
            orders: [],
                search: '',
                field: 'id',
                loading: true,
                options: {},
            headers: [
                                    {
                    text: 'user_id',
                    value: 'user_id'
                },
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
                    text: 'phone',
                    value: 'phone'
                },
                                    {
                    text: 'comment',
                    value: 'comment'
                },
                                    {
                    text: 'street',
                    value: 'street'
                },
                                    {
                    text: 'home',
                    value: 'home'
                },
                                    {
                    text: 'apartment',
                    value: 'apartment'
                },
                                    {
                    text: 'entrance',
                    value: 'entrance'
                },
                                    {
                    text: 'floor',
                    value: 'floor'
                },
                                    {
                    text: 'office',
                    value: 'office'
                },
                                    {
                    text: 'status',
                    value: 'status'
                },
                                    {
                    text: 'payment_id',
                    value: 'payment_id'
                },
                                    {
                    text: 'payment_status',
                    value: 'payment_status'
                },
                                    {
                    text: 'sum',
                    value: 'sum'
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
                                user_id: 0,
                                name: 0,
                                surname: 0,
                                email: 0,
                                phone: 0,
                                comment: 0,
                                street: 0,
                                home: 0,
                                apartment: 0,
                                entrance: 0,
                                floor: 0,
                                office: 0,
                                status: 0,
                                payment_id: 0,
                                payment_status: 0,
                                sum: 0,
                            },
            defaultItem: {
                                user_id: 0,
                                name: 0,
                                surname: 0,
                                email: 0,
                                phone: 0,
                                comment: 0,
                                street: 0,
                                home: 0,
                                apartment: 0,
                                entrance: 0,
                                floor: 0,
                                office: 0,
                                status: 0,
                                payment_id: 0,
                                payment_status: 0,
                                sum: 0,
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
                const test = await this.$axios.get(this.getBackend + 'orders/paginate', { params })
                this.orders = test.data.data
                this.totalOrders = test.data.total
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
                this.editedIndex = this.orders.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            deleteItem (item) {
                this.editedIndex = this.orders.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },
            deleteItemConfirm () {
                this.$axios.$delete(this.getBackend + 'orders/' + this.orders[this.editedIndex].id)
                    .then(() => {
                        this.sum.splice(this.editedIndex, 1)
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
                                formData.append('user_id', this.editedItem.user_id)
                                formData.append('name', this.editedItem.name)
                                formData.append('surname', this.editedItem.surname)
                                formData.append('email', this.editedItem.email)
                                formData.append('phone', this.editedItem.phone)
                                formData.append('comment', this.editedItem.comment)
                                formData.append('street', this.editedItem.street)
                                formData.append('home', this.editedItem.home)
                                formData.append('apartment', this.editedItem.apartment)
                                formData.append('entrance', this.editedItem.entrance)
                                formData.append('floor', this.editedItem.floor)
                                formData.append('office', this.editedItem.office)
                                formData.append('status', this.editedItem.status)
                                formData.append('payment_id', this.editedItem.payment_id)
                                formData.append('payment_status', this.editedItem.payment_status)
                                formData.append('sum', this.editedItem.sum)
                
                if (this.editedIndex > -1) {
                    this.$axios.$post(this.getBackend + 'orders')
                        .then(() => {
                            Object.assign(this.orders[this.editedIndex], formData)
                            this.close()
                        })
                        .catch(() => {
                            this.snackbar.text = 'Возникла ошибка, попробуйте ещё раз'
                            this.snackbar.show = true
                            this.close()
                        })
                } else {
                    this.$axios.$put(this.getBackend + 'orders/' + this.orders[this.editedIndex].id)
                        .then(() => {
                            this.orders.push(formData)
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
