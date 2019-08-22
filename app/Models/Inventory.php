<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['repository_id','mark'];

    public function repository()
    {

        return $this->belongsTo(Repository::class);

    }

    public function bills()
    {

        return $this->hasMany(Bill::class);

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
