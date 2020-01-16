<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Good extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected $softCascade = ['bills@restrict'];

    protected $keepRevisionOf = ['name','type','sort','factory','price','unit','deleted_at'];
    protected $revisionCreationsEnabled = true;
    protected $historyLimit = 5;
    protected $revisionCleanup = true;

    protected $fillable = ['name','type','sort','factory','price','unit','repository_id','user_id'];

    protected $searchable = [
        'columns' => [
            'goods.name' => 10,
            'goods.type' => 10,
            'goods.factory' => 10,
            'goods.price' => 10,
        ],
        'joins' => [
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
        return $query->with('repository');
    }

}

