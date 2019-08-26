<?php

use App\Models\Inventory;

return [
    'title'   => '清单',
    'single'  => '清单',
    'model'   => Inventory::class,


    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'mark' => [
            'title'    => '备注',
        ],
        'repository' => [
            'title'    => '所属仓库',
            'output'   =>  function ($value, $model) {
                $value = e($model->repository->name);
                return '<div>' . model_link($value, $model) . '</div>';
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'mark' => [
            'title' => '备注',
        ],
        'repository' => [
            'title'              => '仓库',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '货品 ID',
        ],
        'mark' => [
            'title' => '备注',
        ],
        'repository' => [
            'title'              => '仓库',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],
    ],
    'rules'   => [
        'mark' => 'string',
    ],
    'messages' => [
        'mark.string' => '备注需为文本',
    ],
];
