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
                        Room Count
                    </label>

                    <div class="col-md-6">
                        <input
                            v-model="room_count"
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
                        Price
                    </label>

                    <div class="col-md-6">
                        <input
                            v-model="total_price"
                            disabled
                            type="number"
                            class="form-control"
                        >
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button
                            @click.prevent="clear"
                            class="btn btn-danger"
                        >
                            Back
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
                    kost_id: this.$props.kost.id || null,
                    name: this.$props.kost.name || null,
                    description: this.$props.kost.description || null,
                    price: this.$props.kost.price || null,
                    room: this.$props.kost.room || null,
                    city: this.$props.kost.city || null,
                    booked_room: this.$props.kost.booked_room || 0,
                    user_id: this.$props.user.id,
                },
                room_count: null,
                total_price: this.$props.kost.price || null,
                notification: null
            }
        },
        mounted() {},
        watch:  {
            room_count: function(val) {
                this.total_price = val*this.$props.kost.price
            }
        },
        methods:{
            clear: function(){
                window.location.href='/'
            },
            submit: function() {
                var self = this

                self.data.booked_room = Number(self.data.booked_room) + Number(self.room_count)
                console.log(self.data.booked_room)
                if (self.data.booked_room > self.data.room) {
                    return alert('Room is full')
                }

                var url = '/api/order'
                /* if (this.$props.kost.id) {
                    url = '/api/order/'+this.$props.kost.id
                } */
                self.data.room_count = Number(self.room_count)
                self.data.total_price = Number(self.total_price)
                self.data.user_id = self.$props.user.id

                axios.post(url, this.data)
                    .then(function (response) {
                        //INSERT
                        if (response.status == 201) {
                            self.notification = 'Order for kost '+response.data.name + ' as many as '+ self.room_count+' has beed saved.'
                        }

                        setTimeout(() => {
                            window.location.href="/"
                        }, 2000)
                        //UPDATE
                        /* if (response.status == 200) {
                            self.notification = response.data.name + 'has beed updated.'
                        }
                        setTimeout(() => {
                            window.location.href="/"
                        }, 2000) */
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    }
</script>
