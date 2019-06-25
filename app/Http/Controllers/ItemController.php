<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\GrandTotal;

class ItemController extends Controller
{
    public function save_item(Request $request)
    {
     $grand_total = new GrandTotal();
     $grand_total->grand_total = $request->grand_total;
     $grand_total->save();
      foreach ($request->products as $value) {
         $item = new Item();
         $item->grand_total_id = $grand_total->id;
         $item->quantity = $value['quantity'];
         $item->unit_price = $value['unit_price'];
         $item->save();
      }
      return response()->json(['success'=>'Successfully Added'],200);
    }
    public function delete_item($id)
    {
      Item::findOrFail($id)->delete();
      return redirect()->back()->with('message','Item Deleted Successfully');
    }
}
