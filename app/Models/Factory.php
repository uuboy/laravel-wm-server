<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factory extends Model
{
    protected $fillable = ['name','code','tel','bank','account','address','last_updater_id','repository_id'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function lastUpdater()
    {
        return $this->belongsTo(User::class,'last_updater_id');
    }

}
