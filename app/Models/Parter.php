<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parter extends Model
{

    protected $fillable = ['user_id','repository_id'];

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function repository()
    {

        return $this->belongsTo(Repository::class);

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
        return $query->with('repository');
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
