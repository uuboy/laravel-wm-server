<?php

namespace App\Models;



class Factory extends Model
{

    protected $keepRevisionOf = ['name','code','tel','bank','account','address','deleted_at'];
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 5;
    protected $revisionCleanup = true;

    protected $fillable = ['name','code','tel','bank','account','address','last_updater_id','repository_id','user_id'];

    protected $searchable = [
        'columns' => [
            'factories.name' => 10,
            'factories.code' => 10,
            'factories.tel' => 10,
            'factories.bank' => 10,
            'factories.account' => 10,
        ],
        'joins' => [
        ],
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function repository()
    {
        return $this->belongsTo(Repository::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lastUpdater()
    {
        return $this->belongsTo(User::class,'last_updater_id');
    }


}
