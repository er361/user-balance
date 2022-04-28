<template>
    <table-component :operations="operations"/>
</template>

<script>
import TableComponent from "./TableComponent";

export default {
    components: {TableComponent},
    data() {
        return {
            operations: []
        }
    },
    methods: {
        async loadData() {

            setInterval(async () => {
                await this.oneTimeLoad();
            }, 15000)
        },
        async oneTimeLoad() {
            try {
                let res = await axios.get('lastFiveOperations');
                this.operations = res.data.data;
            } catch (e) {
                console.error(e)
            }
        }
    },
    beforeDestroy() {
        clearInterval(this.operations)
    },
    created() {
        this.oneTimeLoad();
        this.loadData()
    }
}
</script>
