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
        'name' => [
            'title'    => '名称',
        ],
        'sort' => [
            'title' => '类别',
        ],
        'repository' => [
            'title'    => '所属仓库',
            'output'   =>  function ($value, $model) {
                $value = e($model->repository->name);
                return '<div>' . model_link($value, $model) . '</div>';
            },
        ],
        'receiver' => [
            'title'    => '收货方',
            'output'   =>  function ($value, $model) {
                if($model->receiver_id > 0){
                    $value = e($model->receiver->name);
                    return '<div>' . model_admin_link($value, $model->receiver) . '</div>';
                }else{
                    return '无';
                }

            },
        ],
        'owner' => [
            'title'    => '出货方',
            'output'   =>  function ($value, $model) {
                if($model->owner_id > 0) {
                    $value = e($model->owner->name);
                    return '<div>' . model_admin_link($value, $model->owner) . '</div>';
                }else{
                    return '无';
                }

            },
        ],
        'bill_count' => [
            'title' => '单据数量'
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
         'sort' => [
            'title' => '类别',
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
        'receiver' => [
            'title'              => '收货方',
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
        'owner' => [
            'title'              => '出货方',
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
        'name' => [
            'title' => '名称',
        ],
         'sort' => [
            'title' => '类别',
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
        'receiver' => [
            'title'              => '收货方',
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
        'owner' => [
            'title'              => '出货方',
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
        'sort' => 'required|integer',
        'name' => 'string',
    ],
    'messages' => [
        'name.string' => '名称需为文本',
        'sort.required' => '类别不能为空',
        'sort.integer' => '类别需为整数',
    ],
];
