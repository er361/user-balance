<template>
    <div>
        <div v-if="search">
            <input
                v-model="searchText"
                class="form-control"
                placeholder="Поиск по описанию..."
                type="text"
                @keyup="handleSearchEvent"
            >

        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th>Тип операции</th>
                <th>Сумма</th>
                <th>Баланс</th>
                <th>Описание</th>

                <th v-if="sort" class="hoverable" @click="sendSortEvent">Время
                    <font-awesome-icon v-if="this.sortOrder == 'desc'" icon="fa-solid fa-arrow-down"/>
                    <font-awesome-icon v-else="this.sortOrder == 'asc'" icon="fa-solid fa-arrow-up"/>
                </th>
                <th v-else>Время</th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="loading">Loading...</tr>
            <tr v-for="(operation,index) in operations" v-else>
                <th scope="row">{{ ++index }}</th>
                <td>{{ operation.type }}</td>
                <td>{{ operation.sum }}</td>
                <td>{{ operation.balance }}</td>
                <td>{{ operation.reason }}</td>
                <td>{{ operation.executed_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>

</template>
<script>
export default {
    name: 'table-component',
    props: {
        operations: {},
        sort: false,
        search: false,
    },
    data() {
        return {
            searchText: null,
            loading: true,
            sortOrder: 'desc'
        }
    },
    emits: ['sortByTime', 'search'],
    watch: {
        operations: function (newVal, oldVal) { // watch it
            this.loading = false;
        }
    },
    methods: {
        sendSortEvent() {
            this.changeOrder();
            this.$emit('sortByTime', this.sortOrder)
        },
        changeOrder() {
            if (this.sortOrder === 'desc')
                this.sortOrder = 'asc';
            else
                this.sortOrder = 'desc'
        },
        handleSearchEvent() {
            this.loading = true
            setTimeout(() => {
                this.$emit('search', this.searchText)
            }, 1000)
        }
    }
}
</script>
<style scoped>
.hoverable {
    cursor: pointer;
}
</style>
