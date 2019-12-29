<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['name','sort','repository_id','receiver_id','owner_id','deal_date','factory_id','user_id'];

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

    public function scopeRecentUpdated($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

}
