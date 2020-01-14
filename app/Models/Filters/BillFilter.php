<?php

namespace App\Models\Filters;

use EloquentFilter\ModelFilter;

class BillFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

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
