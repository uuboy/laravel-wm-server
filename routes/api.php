<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1',[
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => ['serializer:array','bindings'],
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        // 小程序登录
        $api->post('weapp/authorizations', 'AuthorizationsController@weappStore')
            ->name('api.weapp.authorizations.store');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');

        // 需要 token 验证的接口
        $api->group(['middleware' => 'api.auth'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 编辑登录用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            $api->put('user', 'UsersController@update')
                ->name('api.user.update');
            // 更新用户头像
            $api->put('user/avatar', 'UsersController@avatar')
                ->name('api.user.avatar');
            //创建仓库
            $api->post('repositories', 'RepositoriesController@store')
                ->name('api.repositories.store');
            //修改仓库
            $api->put('repositories/{repository}', 'RepositoriesController@update')
                ->name('api.repositories.update');
            //删除仓库
            $api->delete('repositories/{repository}', 'RepositoriesController@destroy')
                ->name('api.repositories.destroy');
            //仓库列表
            $api->get('repositories', 'RepositoriesController@index')
                ->name('api.repositories.index');
            //用户仓库列表
            $api->get('users/{user}/repositories', 'RepositoriesController@userIndex')
                ->name('api.users.repositories.index');

            //创建商品
            $api->post('repositories/{repository}/goods', 'GoodsController@store')
                ->name('api.repositories.goods.store');
            //删除商品
            $api->delete('repositories/{repository}/goods/{good}', 'GoodsController@destroy')
                ->name('api.repositories.goods.destroy');
            //修改商品
            $api->put('repositories/{repository}/goods/{good}', 'GoodsController@update')
                ->name('api.repositories.goods.update');
            //仓库商品列表
            $api->get('repositories/{repository}/goods', 'GoodsController@repositoryIndex')
                ->name('api.repositories.goods.index');

            //创建单据
            $api->post('goods/{good}/bills', 'BillsController@store')
                ->name('api.goods.bills.store');
            //删除单据
            $api->delete('goods/{good}/bills/{bill}', 'BillsController@destroy')
                ->name('api.goods.bills.destroy');
            //修改单据
            $api->put('goods/{good}/bills/{bill}', 'BillsController@update')
                ->name('api.goods.bills.update');
            //商品订单列表
            $api->get('goods/{good}/bills', 'BillsController@goodIndex')
                ->name('api.goods.bills.index');

        });
    });
});

// $api->version('v2', function($api) {
//     $api->get('version', function() {
//         return response('this is version v2');
//     });
// });
