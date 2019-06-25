

require('./bootstrap');
window.Vue = require('vue');
import Swal from 'sweetalert2'
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
var app = new Vue({
    el: "#app",
    data: {
        errors:[],
        grand_total:0,
        products: [{
            quantity: '',
            unit_price:'',
            total: ''
        }]
    },
    methods: {
        addNewRow(){
            this.products.push({
                quantity: '',
                unit_price:'',
                total: ''
            });
        },
        removeRow(index,product){
            var idx = this.products.indexOf(product);
            if (idx > -1) {
                this.products.splice(idx, 1);
            }
            this.calculateGrandTotal();
        },
        calculateTotal(product){
           let total = parseFloat(product.quantity) * parseFloat(product.unit_price);
           if (!isNaN(total)) {
            product.total = total.toFixed(2);
         }
         this.calculateGrandTotal();
        },
        saveItem(){
            axios.post('save-item',{products:this.products,grand_total:this.grand_total})
            .then(response=>{
                Toast.fire({
                    type: 'success',
                    title: 'Successfully Added'
                  })
            })
            .catch(error=>{
                if (error.response.status == 422){
                    this.errors = error.response.data.errors;
                   }
            })
        },
        calculateGrandTotal() {
            let subtotal;
            subtotal = this.products.reduce(function (sum, product) {
                var total = parseFloat(product.total);
                if (!isNaN(total)) {
                    return sum + total;
                }
            }, 0);

            this.grand_total  = subtotal
        },
       
    },
   
 
});