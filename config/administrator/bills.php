<?php

use App\Models\Bill;

return [
    'title'   => '单据',
    'single'  => '单据',
    'model'   => Bill::class,


    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'num' => [
            'title' => '数量',
        ],
        'good' => [
            'title'    => '商品',
            'output'   =>  function ($value, $model) {
                $value = e($model->good->name);
                return '<div>' . model_admin_link($value, $model->good) . '</div>';
            },
        ],
        'inventory' => [
            'title'    => '所属清单',
            'output'   =>  function ($value, $model) {
                $value = e($model->inventory->name);
                return '<div>' . model_admin_link($value, $model->inventory) . '</div>';
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'sort' => [
            'title' => '类别',
        ],
        'num' => [
            'title' => '数量',
        ],
        'good' => [
            'title'              => '商品',
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
        'inventory' => [
            'title'              => '所属清单',
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
        'sort' => [
            'title' => '类别',
        ],
        'num' => [
            'title' => '数量',
        ],
        'inventory' => [
            'title'              => '所属清单',
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
        'num' => 'required|integer',
    ],
    'messages' => [
        'num.required' => '数量不能为空',
        'num.integer' => '数量需为整数',
    ],
];
