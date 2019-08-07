<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['sort','num','good_id','inventory_id','receiver_id','owner_id'];

    public function good()
    {

        return $this->belongsTo(Good::class);

    }

    public function inventory()
    {

        return $this->belongsTo(Inventory::class);

    }

    public function receiver()
    {

        return $this->belongsTo(Receiver::class);

    }

    public function owner()
    {

        return $this->belongsTo(Owner::class);

    }

}
