<template>
    <div class="card">
        <div class="card-header">
            {{config.label}}
            <span
                class="float-right"
                style="color:green;"
            >
                {{notification}}
            </span>
        </div>
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
            kost: {
                type: Object,
                default: () => {},
            },
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
                    name: this.$props.kost.name || null,
                    description: this.$props.kost.description || null,
                    price: this.$props.kost.price || null,
                    room: this.$props.kost.room || null,
                    city: this.$props.kost.city || null,
                    user_id: this.$props.user.id,
                },
                notification: null
            }
        },
        mounted() {},
        methods:{
            submit: function() {
                var self = this

                var url = '/api/kost'
                if (this.$props.kost.id) {
                    url = '/api/kost/'+this.$props.kost.id
                }

                axios.post(url, this.data)
                    .then(function (response) {
                        //INSERT
                        if (response.status == 201) {
                            self.notification = response.data.name + 'has beed saved.'
                        }
                        //UPDATE
                        if (response.status == 200) {
                            self.notification = response.data.name + 'has beed updated.'
                        }
                        setTimeout(() => {
                            window.location.href="/"
                        }, 2000)
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    }
</script>
