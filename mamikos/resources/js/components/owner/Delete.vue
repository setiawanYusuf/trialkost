<template>
    <button
        @click.prevent="remove"
        class="btn btn-warning"
    >
        Delete
    </button>
</template>

<script>
    export default {
        props: {
            kost: {
                type: Object,
                default: () => {},
            },
        },
        methods: {
            remove: function() {
                var self = this
                console.log(self.$props.kost.id)
                if (confirm('Are you sure to delete '+self.$props.kost.name+' ?')) {
                    axios.delete('/api/kost/'+self.$props.kost.id, self.data)
                        .then(function (response) {
                            //UPDATE
                            if (response.status == 204) {
                                if (!alert('Data '+self.$props.kost.name+' has been deleted.')) {
                                    window.location.href='/'
                                }
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                }
            }
        }
    }
</script>
