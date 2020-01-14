<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use EloquentFilter\Filterable;
use Venturecraft\Revisionable\RevisionableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Watson\Rememberable\Rememberable;

class Model extends EloquentModel
{
    use Filterable,SearchableTrait,RevisionableTrait;
    use Rememberable;

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
