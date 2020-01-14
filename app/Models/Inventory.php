<?php

namespace App\Models;


class Inventory extends Model
{
    protected $keepRevisionOf = ['name','deleted_at'];
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 5;
    protected $revisionCleanup = true;
    protected $fillable = ['name','sort','repository_id','receiver_id','owner_id','deal_date','factory_id','user_id'];

    protected $searchable = [
        'columns' => [
            'inventories.name' => 10,
            'users.name' => 10,
            'factories.name' => 10,
        ],
        'joins' => [
            'users' => ['users.id','inventories.user_id'],
            'factories' => ['factories.id','inventories.factory_id']
        ],
    ];

    public function repository()
    {

        return $this->belongsTo(Repository::class);

    }

    public function bills()
    {

        return $this->hasMany(Bill::class);

    }

     public function receiver()
    {

        return $this->belongsTo(User::class,'receiver_id');

    }

    public function factory()
    {
        return $this->belongsTo(Factory::class);
    }

    public function owner()
    {

        return $this->belongsTo(User::class,'owner_id');

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
