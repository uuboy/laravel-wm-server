<?php

namespace App\Models;


class Repository extends Model
{
    protected $keepRevisionOf = ['name','deleted_at'];
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 5;
    protected $revisionCleanup = true;

    protected $searchable = [
        'columns' => [
            'repositories.name' => 10,
        ],
        'joins' => [
        ],
    ];

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



}
