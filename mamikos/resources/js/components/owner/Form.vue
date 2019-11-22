<template>
    <div class="card">
        <div class="card-header">{{config.label}}</div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Name
                    </label>

                    <div class="col-md-6">
                        <input
                            v-model="data.name"
                            type="text"
                            class="form-control"
                            required
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Description
                    </label>

                    <div class="col-md-6">
                        <textarea
                            v-model="data.description"
                            class="form-control rounded-0"
                            required
                        >
                        </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Price
                    </label>

                    <div class="col-md-6">
                        <input
                            v-model="data.price"
                            type="number"
                            class="form-control"
                            required
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                    >
                        Room
                    </label>

                    <div class="col-md-6">
                        <input
                            v-model="data.room"
                            type="number"
                            class="form-control"
                            required
                        >
                    </div>
                </div>

                <div class="form-group row">
                    <label
                        class="col-md-4 col-form-label text-md-right"
                    >
                        City
                    </label>

                    <div class="col-md-6">
                        <input
                            v-model="data.city"
                            type="text"
                            class="form-control"
                            required
                        >
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button
                            @click.prevent="clear"
                            class="btn btn-danger"
                        >
                            Clear
                        </button>
                        <button
                            @click.prevent="submit"
                            class="btn btn-success"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            config: {
                type: Object,
                default: () => {},
            },
            user: {
                type: Object,
                default: () => {},
            }
        },
        data() {
            return {
                data:{
                    name: null,
                    description: null,
                    price: null,
                    room: null,
                    city: null,
                    user_id: this.$props.user.id,
                }
            }
        },
        mounted() {},
        methods:{
            submit: function() {
                axios.post('/api/kost', this.data)
                    .then(function (response) {
                        // handle success
                        console.log(response);
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .finally(function () {
                        // always executed
                    });
            }
        }
    }
</script>
