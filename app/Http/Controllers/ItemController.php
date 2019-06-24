<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    public function save_item(Request $request)
    {
     
      foreach ($request->products as $value) {
        // $request->validate(
        //  [
        //     'quantity'=>'required',
        //     'unit_price'=>'required',
        //  ]
        // );
         $item = new Item();
         $item->quantity = $value['quantity'];
         $item->unit_price = $value['unit_price'];
         $item->save();
      }
      return response()->json(['success'=>'Successfully Added'],200);
    }
}
