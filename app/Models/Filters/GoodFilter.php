<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class GoodFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function lastUpdater($id)
    {
        return $this->where('last_updater_id',$id);
    }

    public function name($value)
    {
        return $this->whereLike('name',$value);
    }

    public function type($value)
    {
        return $this->whereLike('type',$value);
    }

    public function sort($value)
    {
        return $this->where('sort',$value);
    }

    public function factory($value)
    {
        return $this->whereLike('factory',$value);
    }

    public function order($value)
    {
        switch ($value) {
            case 'recentCreated':
                $this->recentCreated();
                break;
            case 'recentUpdated':
                $this->recentUpdated();
                break;
            default:
                $this->recentUpdated();
                break;
        }
    }


    public function setup()
    {
        // 如果没有传 order，则默认使用 default
        if (!$this->input('order'))  {
            $this->push('order', 'default');
        }
    }
}
