@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <h1>List Of Items</h1>

                <p class="description">
                  @if (session()->get('message'))
                     <h4 class="alert alert-success"> {{session()->get('message')}}</h4>
                  @endif
                </p>
                
                <ul class="accordion">
                  @foreach (\App\GrandTotal::all() as $grand_total)
                      
                    <li>
                        <a class="toggle text-center" href="javascript:void(0);">Grand Total - {{$grand_total->grand_total}}</a> 
                        <ul class="inner">
                           
                        <table id="example {{$grand_total->id}}" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($grand_total->items as $item)
                                        <tr>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->unit_price}}</td>
                                            <td>{{$item->quantity * $item->unit_price}}</td>
                                        <td><a class="btn btn-danger" href="{{route('delete.item',$item->id)}}">Delete</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            
                           
                        </ul>
                    </li>
      
                  @endforeach
                </ul>
        </div>
    </div>
</div>

@endsection
