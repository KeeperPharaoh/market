export const state = () => ({
    data: 'http://127.0.0.1:8001/api/v1/admin/',
    storage: 'http://127.0.0.1:8001/storage/'
})

export const getters = {
    getBackend: (state) => {
        return state.data
    },
    getStorage: (state) => {
        return state.storage
    }
}
