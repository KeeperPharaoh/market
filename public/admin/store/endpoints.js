export const state = () => ({
    data: 'http://localhost/api/v1/admin/',
    storage: 'http://localhost/storage/'
})

export const getters = {
    getBackend: (state) => {
        return state.data
    },
    getStorage: (state) => {
        return state.storage
    }
}
