<?php

use App\Models\Repository;

return [
    'title'   => '仓库',
    'single'  => '仓库',
    'model'   => Repository::class,


    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '名称',
        ],
        'user' => [
            'title'    => '所属用户',
            'output'   => function ($value, $model) {
                $avatar = e($model->user->avatar);
                $value = empty($avatar) ? 'N/A' : '<img src="'.$avatar.'" style="height:22px;width:22px"> ' . e($model->user->name);
                return model_admin_link($value, $model->user);
            },
        ],
        'operation' => [
            'title'  => '管理',
            'sortable' => false,
        ],
    ],
    'edit_fields' => [
        'name' => [
            'title' => '名称',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',

            // 自动补全，对于大数据量的对应关系，推荐开启自动补全，
            // 可防止一次性加载对系统造成负担
            'autocomplete'       => true,

            // 自动补全的搜索字段
            'search_fields'      => ["CONCAT(id, ' ', name, ' ', email)"],

            // 自动补全排序
            'options_sort_field' => 'id',
        ],
    ],
    'filters' => [
        'id' => [
            'title' => '仓库 ID',
        ],
        'name' => [
            'title' => '名称',
        ],
        'user' => [
            'title'              => '用户',
            'type'               => 'relationship',
            'name_field'         => 'name',
            'autocomplete'       => true,
            'search_fields'      => array("CONCAT(id, ' ', name, ' ', email)"),
            'options_sort_field' => 'id',
        ],
    ],
    'rules'   => [
        'name' => 'required'
    ],
    'messages' => [
        'name.required' => '请确保名字不为空',
    ],
];
