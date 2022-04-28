<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th>Тип операции</th>
            <th>Сумма</th>
            <th>Баланс</th>
            <th v-if="search"> Описание <input v-model="searchText"
                                               class="form-control"
                                               placeholder="Поиск по описанию"
                                               type="text"
                                               @keyup="handleSearchEvent">
            </th>
            <th v-else>Описание</th>

            <th v-if="sort" class="hoverable" @click="sendSortEvent">Время |
                <span class="text-success">Sort:{{ this.sortOrder }}</span>
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
            console.log('Prop changed: ', newVal, ' | was: ', oldVal)
            this.loading = false;
        }
    },
    methods: {
        sendSortEvent() {
            this.changeOrder();
            this.$emit('sortByTime', this.sortOrder)
            console.log('emit', this.sortOrder)
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
                console.log(this.searchText)
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
