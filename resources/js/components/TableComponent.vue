<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th>Тип операции</th>
            <th>Сумма</th>
            <th>Баланс</th>
            <th>Описание</th>

            <th v-if="sort" class="hoverable" @click="sendSortEvent">Время |
                <span class="text-success">Sort:{{ this.sortOrder }}</span>
            </th>
            <th v-else>Время</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(operation,index) in operations">
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
    },
    data() {
        return {
            sortOrder: 'desc'
        }
    },
    emits: ['sortByTime'],
    methods: {
        sendSortEvent() {
            let order = this.changeOrder();
            this.$emit('sortByTime', this.sortOrder)
            console.log('emit', this.sortOrder)
        },
        changeOrder() {
            if (this.sortOrder === 'desc')
                this.sortOrder = 'asc';
            else
                this.sortOrder = 'desc'
        }
    }
}
</script>
<style scoped>
.hoverable {
    cursor: pointer;
}
</style>
