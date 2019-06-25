<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrandTotal extends Model
{
    protected $guarded = [];
    public function items(){
        return $this->hasMany(Item::class);
    }
}
