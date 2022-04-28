<template>
    <table-component :operations="operations" :sort="true" @sortByTime="sort"></table-component>
</template>

<script>
import TableComponent from "./TableComponent";

export default {
    name: "TableFull",
    components: {TableComponent},
    data() {
        return {
            operations: [],
        }
    },
    created() {
        this.loadFullOperationsData()
    },
    methods: {
        async loadFullOperationsData(sortOrder = 'desc') {
            try {
                let res = await axios.get(`getUserAccountOperations?sortOrder=${sortOrder}`);
                console.log(res)
                this.operations = res.data.data;
            } catch (e) {
                console.error(e)
            }
        },
        sort(order) {
            console.log('sorting', order)
            this.loadFullOperationsData(order)
        }
    }
}
</script>

<style scoped>

</style>
