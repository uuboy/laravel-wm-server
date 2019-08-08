<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['sort','num','good_id','inventory_id','receiver_id','owner_id'];

    public function good()
    {

        return $this->belongsTo(Good::class);

    }

    public function inventory()
    {

        return $this->belongsTo(Inventory::class);

    }

    public function receiver()
    {

        return $this->belongsTo(User::class,'receiver_id');

    }

    public function owner()
    {

        return $this->belongsTo(User::class,'owner_id');

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
        return $query->with('good');
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
