<template>
    <div>
        <div class="row justify-content-center">
            <div
                class="card"
                style="
                    width: 60rem;
                    margin-bottom: 10px;
                ">
                <div class="card-body">
                    <h5 class="card-title">Filter</h5>
                </div>
                <div class="card-body">
                    <div class="form-group col-md-12">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="filter.name">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Price(from)</label>
                        <input type="number" class="form-control" v-model="filter.priceFrom">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Price(to)</label>
                        <input type="number" class="form-control" v-model="filter.priceTo">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputState">Sort Price</label>
                        <select
                            id="inputState"
                            class="form-control"
                            v-model="filter.sortPrice"
                        >
                            <option selected>Ascending</option>
                            <option selected>Descending</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputState">City</label>
                        <select
                            id="inputState"
                            class="form-control"
                            v-model="filter.city"
                        >
                            <option selected>All</option>
                            <option v-for="(item, index) in cities">{{item.city}}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button
                            type="button"
                            class="btn btn-success"
                            @click="sort"
                        >
                            Sort
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="data" class="row justify-content-center">
            <div
                class="card"
                style="width: 18rem;"
                v-for="(item, index) in data"
            >
                <img
                    :src="item.image_url"
                    class="card-img-top"
                    alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{item.name}}</h5>
                    <p class="card-text">{{item.description}}</p>
                    <a
                        :href="item.detailUri"
                        class="btn btn-success"
                    >
                        Detail
                    </a>
                    <span v-if="user">
                        <span v-if="user.role_id == 3 || user.role_id == 4">
                            <a
                                :href="item.orderAddUri"
                                class="btn btn-primary"
                            >
                                Book
                            </a>
                        </span>
                        <span v-if="user.role_id == 2">
                            <a
                                :href="item.ownerEditUri"
                                class="btn btn-primary"
                            >
                                Edit
                            </a>
                            <delete-button
                                :kost="item"
                            ></delete-button>
                        </span>
                    </span>
                </div>
            </div>
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
            cities: {
                type: Array,
                default: () => {},
            },
        },
        data() {
            return {
                data: null,
                filter: {
                    name: null,
                    city: 'All',
                    priceFrom: null,
                    priceTo: null,
                    sortPrice: 'Ascending',
                }
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
                        value.detailUri = '/kost/'+value.id
                        value.orderAddUri = '/order/add/'+value.id
                        value.ownerEditUri = '/owner/edit/'+value.id
                        return value
                    })
                },
            },
        },
        methods:{
            fetchApi: function() {
                var self = this

                var url = '/api/kost/'
                if (self.user) {
                    if (self.user.role_id == 2) {
                        url = '/api/kost/owner/'+self.user.id
                    }
                }

                axios.get(url)
                    .then(function (response) {
                        if (response.status == 200) {
                            self.mappedData = response.data.data
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            sort: function() {
                var self = this
                var filterSortPrice = 'asc'
                if (self.filter.sortPrice == 'Descending') {
                    filterSortPrice = 'desc'
                }
                self.filter.sortPrice = filterSortPrice

                axios.post('/api/kost/filter', self.filter)
                    .then(function (response) {
                        if (response.status == 200) {
                            self.mappedData = response.data
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    }
</script>
