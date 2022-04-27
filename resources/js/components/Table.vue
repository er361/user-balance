<template>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th>Тип операции</th>
            <th>Сумма</th>
            <th>Баланс</th>
            <th>Описание</th>
            <th>Время</th>
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
                console.log(res)
                this.operations = res.data;
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
