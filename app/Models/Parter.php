<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;


class Parter extends Model
{
    use SoftDeletes, SoftCascadeTrait;

    protected $keepRevisionOf = ['user_id','repository_id'];
    protected $revisionCreationsEnabled = false;
    protected $historyLimit = 5;
    protected $revisionCleanup = true;
    protected $searchable = [
        'columns' => [
            'users.name' => 10,
        ],
        'joins' => [
            'users' => ['users.id','parters.user_id'],
        ],
    ];

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

}
