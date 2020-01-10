<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
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

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentUpdated();
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('user');
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
