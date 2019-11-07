<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $fillable = ['name','code','tel','bank','account','address'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

}
