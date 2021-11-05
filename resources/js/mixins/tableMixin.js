import moment from 'moment'

export default {

    data() {
        return {
            data: [],
            search: ''
        }
    },

    methods: {
        shorten(text) {
            return _.truncate(text);
        },

        formatDate(datetime) {
            return moment(datetime).format('DD/MM/Y')
        }
    },
    computed: {
        filteredItems() {
            return this.data.filter(item => {
                return item[this.searchColumn].toLowerCase().includes(this.search.toLowerCase())
            })
        }
    }
}
