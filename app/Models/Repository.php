<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use Venturecraft\Revisionable\RevisionableTrait;

class Repository extends Model
{
    use Filterable,RevisionableTrait;
    protected $keepRevisionOf = ['name','deleted_at'];
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 50;
    protected $revisionCleanup = true;
    protected $fillable = ['name','user_id'];
    public function user()
    {

        return $this->belongsTo(User::class);

    }

    public function goods()
    {

        return $this->hasMany(Good::class);

    }

    public function inventories()
    {

        return $this->hasMany(Inventory::class);

    }

    public function parterUsers()
    {

        return $this->belongsToMany(User::class,'parters');
    }

    public function parters()
    {
        return $this->hasMany(Parter::class);
    }

    public function lastUpdater()
    {
        return $this->belongsTo(User::class,'last_updater_id');
    }

    public function factories()
    {
        return $this->hasMany(Factory::class);
    }

    public function scopeRecentUpdated($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
    public function scopeRecentCreated($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

}
