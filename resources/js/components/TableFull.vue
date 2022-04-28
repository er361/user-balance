<template>
    <table-component :operations="operations"
                     :search="true"
                     :sort="true"
                     @search="search"
                     @sortByTime="sort"/>
</template>

<script>
import TableComponent from "./TableComponent";

export default {
    name: "TableFull",
    components: {TableComponent},
    data() {
        return {
            operations: [],
            sortOrder: 'desc',
        }
    },
    created() {
        this.loadFullOperationsData()
    },

    methods: {
        async loadFullOperationsData(order = 'desc', search = '') {
            try {
                let res = await axios
                    .get(`getUserAccountOperations?sortOrder=${order}&search=${search}`);
                this.operations = res.data.data;
            } catch (e) {
                console.error(e)
            }
        },
        sort(order) {
            this.loadFullOperationsData(order)
        },
        search(text) {
            this.loadFullOperationsData('desc', text)
        },

    }
}
</script>

<style scoped>

</style>
