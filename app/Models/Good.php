<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = ['name','type','sort','factory','price','unit','repository_id'];

    public function repository()
    {

        return $this->belongsTo(Repository::class);

    }

    public function bills()
    {

        return $this->hasMany(Bill::class);

    }

}

