<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;


class Bill extends Model
{
    use SoftDeletes;

    protected $keepRevisionOf = ['deleted_at'];
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 5;
    protected $revisionCleanup = true;

    protected $fillable = ['sort','num','good_id','inventory_id','user_id','last_updater_id'];

    protected $searchable = [
        'columns' => [
            'goods.name' => 10,
        ],
        'joins' => [
            'goods' => ['goods.id','bills.good_id'],
            'inventories' => ['inventories.id','bills.inventory_id'],
        ],
    ];

    public function good()
    {

        return $this->belongsTo(Good::class);

    }

    public function inventory()
    {

        return $this->belongsTo(Inventory::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lastUpdater()
    {
        return $this->belongsTo(User::class,'last_updater_id');
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
    public function scopeRecentCreated($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

}
