<template>
    <div v-if="data" class="row justify-content-center">
        <div
            class="card"
            style="width: 40rem;"
        >
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Kost Name</th>
                        <th scope="col">Room Count</th>
                        <th scope="col">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in data">
                        <th scope="row">{{item.id}}</th>
                        <td>{{item.user.name}}</td>
                        <td>{{item.kost.name}}</td>
                        <td>{{item.room_count}}</td>
                        <td>{{item.total_price}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: {
                type: Object,
                default: () => {},
            },
        },
        data() {
            return {
                data: null,
            }
        },
        mounted() {
            this.fetchApi()
        },
        watch:  {},
        computed: {
            mappedData: {
                get: function() {
                },
                set: function(items) {
                    this.data = items
                    Object.values(this.data).map(value => {

                    })
                },
            },
        },
        methods:{
            fetchApi: function() {
                var self = this

                var url = '/api/order/owner/'+self.user.id
console.log(url)
                axios.get(url)
                    .then(function (response) {
                        if (response.status == 200) {
                            self.mappedData = response.data
                            console.log(response.data)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
        }
    }
</script>

