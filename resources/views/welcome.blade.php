<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- FontAwsome --}}
    <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
</head>
    <body>
        <div class="container">
            <div id="app">
               <div class="row">
                    <form @submit.prevent="saveItem">
                        <div class="col-md-12">
                            <table class="table table-striped table-inverse table-responsive text-center">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total </th>
                                    </tr>
                                </thead>
                                
                               
                                <tbody>
                                    <tr v-for="(product,index) in products" :key="index">
                                        <td>
                                            <input class="form-control text-right" @keyup="calculateTotal(product)" placeholder="Quantity" type="number" min="0" step="1" v-model="product.quantity"/>
                                        </td>
                                        <td>
                                            <input class="form-control text-right" @keyup="calculateTotal(product)" type="number" placeholder="Unit Price" min="0" step="10" v-model="product.unit_price"/>
                                        </td>
                                        <td>
                                            <input readonly class="form-control text-right" type="number" placeholder="Total Price" min="0" step=".01" v-model="product.total" />
                                        </td>
                                        <td v-if="index==0">
                                            <button type='button' @click="addNewRow" class="btn btn-info">
                                                Add
                                                <i class="fa fa-plus"></i>
                                            </button> 
                                        </td>
                                        <td v-else>
                                            <button type='button' @click="removeRow(index,product)" class="btn btn-danger">
                                                    Remove
                                                    <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div v-for="error in errors">
                                        <div v-for="err in error">
                                            <div class="alert alert-danger">@{{err}} </div>
                                        </div>
                                    </div>
                                </tbody>
                            </table>
                            <div class="float-right">
                                Grand Total: @{{grand_total}}
                                
                            </div> <hr/><br><br>
                            <div class="text-center">
                                <button type='submit' class="btn btn-success" @click.prevent="saveItem">
                                    <i class="far fa-save"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </body>
</html>
