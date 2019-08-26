<?php

use App\Models\Good;

return [
    'title'   => '商品',
    'single'  => '商品',
    'model'   => Good::class,


    'columns' => [
        'id' => [
            'title' => 'ID',
        ],
        'name' => [
            'title'    => '名称',
        ],
        'type' => [
            'title' => '规格',
        ],
        'sort' => [
            'title' => '类别',
        ],
        'factory' =>[
            'title' => '生产厂家',
        ],
        'price' => [
            'title' => '价格',
        ],
        'unit' =>[
            'title' => '计量单位',
        ],
        'num' =>[
            'title' => '数量',
        ],
        'repository' => [
            'title'    => '所属仓库',
            'output'   =>  function ($value, $model) {
                $value = e($model->repository->name);
                return '<div>' . model_admin_link($value, $model->repository) . '</div>';
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
        'type' => [
            'title' => '规格',
        ],
        'sort' => [
            'title' => '类别',
        ],
        'factory' => [
            'title' => '生产厂家',
        ],
        'price' => [
            'title' => '价格',
        ],
        'unit' =>[
            'title' => '计量单位',
        ],
        'num' =>[
            'title' => '数量',
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
        'name' => [
            'title' => '名称',
        ],
        'type' => [
            'title' => '规格',
        ],
        'sort' => [
            'title' => '类别',
        ],
        'factory' => [
            'title' => '生产厂家',
        ],
        'price' => [
            'title' => '价格',
        ],
        'unit' =>[
            'title' => '计量单位',
        ],
        'num' =>[
            'title' => '数量',
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
        'name' => 'required|string',
        'type' => 'string',
        'sort' => 'required|integer',
        'factory' => 'string',
        'price' => 'numeric',
        'unit' => 'string',
        'num' => 'required|integer',
    ],
    'messages' => [
        'name.required' => '名称不能为空',
        'name.string' => '名称需为文本',
        'type.string' => '规格需为文本',
        'sort.required' => '类别不能为空',
        'sort.integer' => '类别需为整数',
        'factory.string' => '生产厂商需为文本',
        'price.numric' => '价格需为数字',
        'unit.string' => '计量单位需为文本',
        'num.required' => '数量不能为空',
        'num.integer' => '数量必须为整数',
    ],
];
