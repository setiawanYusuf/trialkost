/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('list-kost', require('./components/kost/List.vue').default);

Vue.component('owner-form', require('./components/owner/Form.vue').default);
Vue.component('delete-button', require('./components/owner/Delete.vue').default);

Vue.component('list-order', require('./components/order/List.vue').default);
Vue.component('order-form', require('./components/order/Form.vue').default);

Vue.component('user-form', require('./components/user/Form.vue').default);
Vue.component('book-button', require('./components/user/Book.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function(){
    //CHECK ROOM AVAILABILITY
    $('#btn-see-availability').click(function(){
        let idKost = $('#btn-see-availability').attr("data-idKost")
        let user = JSON.parse( $('#btn-see-availability').attr("data-idUser") )
        var self = this

        axios.post('/api/kost/available-room', {id: idKost})
            .then(function (response) {
                if (response.status == 200) {

                    //UPDATE CREDIT POINT
                    axios.post('/api/user/minus-credit-point', {idUser: user.id, idKost: idKost})
                        .then(function (response2) {
                            if (response2.status == 200) {
                                let credit_point_temp = response2.data.credit_point

                                if (credit_point_temp > 0) {
                                    $('#navbarDropdown').text(user.name+' - Points: '+credit_point_temp)
                                    $('#btn-see-availability').addClass('d-none')

                                    alert('Your credit point has been reduced by 5 point.')
                                    let res = 'Available room: '+ (response.data.room - response.data.booked_room)
                                    $('#available-room').text(res).removeClass('d-none')
                                } else {
                                    alert('Your credit point is 0, you can`t see available room.')
                                }
                            }
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                }
            })
            .catch(function (error) {
                console.log(error);
            })
    })
})
