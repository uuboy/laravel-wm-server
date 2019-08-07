<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable=['user_id'];

    public function user()
    {

        return $this->belongsTo(Use::class);
    }

    public function bill()
    {

        return $this->hasOne(Bill::class);

    }
}
