<?php

use App\Models\Parter;

return [
    'title'   => '协作者',
    'single'  => '协作者',
    'model'   => Parter::class,


    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'repository' => [
            'title'    => '仓库',
            'output'   =>  function ($value, $model) {
                $value = e($model->repository->name);
                return '<div>' . model_admin_link($value, $model->repository) . '</div>';
            },
        ],
        'user' => [
            'title'    => '协作用户',
            'output'   =>  function ($value, $model) {
                $value = e($model->user->name);
                return '<div>' . model_admin_link($value, $model->user) . '</div>';
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
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
        'user' => [
            'title'              => '协作用户',
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
        'user' => [
            'title'              => '协作用户',
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

    ],
    'messages' => [

    ],
];
