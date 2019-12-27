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
    'middleware' => ['serializer:array','bindings','change-locale'],
], function($api) {
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {
        // 小程序登录
        $api->post('weapp/authorizations', 'AuthorizationsController@weappLogin')
            ->name('api.weapp.authorizations.login');
        //手机号注册
        $api->post('weapp/register','AuthorizationsController@weappStore')
            ->name('api.weapp.authorizations.store');
        // $api->post('weapp/decrypt','AuthorizationsController@decrypt')
        //     ->name('api.weapp.authorizations.decrypt');
        // 刷新token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
        // 删除token
        $api->delete('authorizations/current', 'AuthorizationsController@destroy')
            ->name('api.authorizations.destroy');
        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        });
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.access.limit'),
        'expires' => config('api.rate_limits.access.expires'),
    ], function($api) {
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
            $api->post('repositories', 'RepositoriesController@create')
                ->name('api.repositories.create');
            //修改仓库
            $api->put('repositories/{repository}', 'RepositoriesController@update')
                ->name('api.repositories.update');
            //删除仓库
            $api->delete('repositories/{repository}', 'RepositoriesController@destroy')
                ->name('api.repositories.destroy');
            //获取仓库
            $api->get('repositories/{repository}','RepositoriesController@show')
                ->name('api.repositories.show');
            //用户仓库列表
            $api->get('repositories', 'RepositoriesController@userIndex')
                ->name('api.repositories.index');
            //用户协作仓库列表
            $api->get('parter/repositories','RepositoriesController@parterIndex')
                ->name('api.parter.repositories.index');



            //创建商品
            $api->post('repositories/{repository}/goods', 'GoodsController@store')
                ->name('api.repositories.goods.store');
            //删除商品
            $api->delete('repositories/{repository}/goods/{good}', 'GoodsController@destroy')
                ->name('api.repositories.goods.destroy');
            //修改商品
            $api->put('repositories/{repository}/goods/{good}', 'GoodsController@update')
                ->name('api.repositories.goods.update');
            //获取商品
            $api->get('repositories/{repository}/goods/{good}','GoodsController@show')
                ->name('api.repositories.goods.show');
            //仓库商品列表
            $api->get('repositories/{repository}/goods', 'GoodsController@repositoryIndex')
                ->name('api.repositories.goods.index');


            //创建清单
            $api->post('repositories/{repository}/inventories','InventoriesController@create')
                ->name('api.repositories.inventories.create');
            //删除清单
            $api->delete('repositories/{repository}/inventories/{inventory}','InventoriesController@destroy')
                ->name('api.repositories.inventories.destroy');
            //修改清单
            $api->put('repositories/{repository}/inventories/{inventory}','InventoriesController@update')
                ->name('api.repositories.inventories.update');
            //获取清单
            $api->get('repositories/{repository}/inventories/{inventory}','InventoriesController@show')
                ->name('api.repositories.inventories.show');
            //仓库清单列表
            $api->get('repositories/{repository}/inventories','InventoriesController@repositoryIndex')
                ->name('api.repositories.inventories.repositoryIndex');
            //用户收货清单列表
            $api->get('users/{user}/receiver/inventories', 'InventoriesController@receiverIndex')
                ->name('api.users.receiver.inventories.index');
            //用户出货清单列表
            $api->get('users/{user}/owner/inventories', 'InventoriesController@ownerIndex')
                ->name('api.users.owner.inventories.index');



            //创建单据
            $api->post('repositories/{repository}/inventories/{inventory}/goods/{good}/bills', 'BillsController@store')
                ->name('api.repositories.inventories.goods.bills.store');
            //删除单据
            $api->delete('repositories/{repository}/inventories/{inventory}/goods/{good}/bills/{bill}', 'BillsController@destroy')
                ->name('api.repositories.inventories.goods.bills.destroy');
            //修改单据
            $api->put('repositories/{repository}/inventories/{inventory}/goods/{good}/bills/{bill}', 'BillsController@update')
                ->name('api.repositories.inventories.goods.bills.update');
            //获取单据
            $api->get('repositories/{repository}/inventories/{inventory}/goods/{good}/bills/{bill}', 'BillsController@show')
                ->name('api.repositories.inventories.goods.bills.show');
            //商品订单列表
            $api->get('repositories/{repository}/goods/{good}/bills', 'BillsController@goodIndex')
                ->name('api.repositories.goods.bills.goodindex');
             //清单单据列表
            $api->get('repositories/{repository}/inventories/{inventory}/bills','BillsController@inventoryIndex')
                ->name('api.repositories.inventories.bills.inventoryIndex');



            //创建协作者
            $api->post('repositories/{repository}/parters','PartersController@create')
                ->name('api.repositories.parters.create');
            //删除协作者
            $api->delete('repositories/{repository}/parters/{parter}','PartersController@destroy')
                ->name('api.repositories.parters.destroy');
            //仓库协作列表
            $api->get('repositories/{repository}/parters','PartersController@repositoryIndex')
                ->name('api.repositories.parters.index');
            //用户协作列表
            $api->get('users/{user}/parters','PartersController@userIndex')
                ->name('api.users.parters.index');

            //用户通知列表
            $api->get('user/notifications','NotificationsController@index')
                ->name('api.users.notifications.index');
            //用户通知统计
            $api->get('user/notifications/stats', 'NotificationsController@stats')
                ->name('api.user.notifications.stats');
            // 标记消息通知为已读
            $api->put('user/read/notifications', 'NotificationsController@read')
                ->name('api.user.notifications.read');
                // 当前登录用户权限
            $api->get('user/permissions', 'PermissionsController@index')
                ->name('api.user.permissions.index');

            //创建往来单位
            $api->post('repositories/{repository}/factories','FactoriesController@create')
                ->name('api.repositories.factories.create');
            //修改往来单位
            $api->put('repositories/{repository}/factories/{factory}','FactoriesController@update')
                ->name('api.repositories.factories.update');
            //删除往来单位
            $api->delete('repositories/{repository}/factories/{factory}','FactoriesController@destroy')
                ->name('api.repositories.factories.destroy');
            //往来单位列表
            $api->get('repositories/{repository}/factories','FactoriesController@index')
                ->name('api.repositories.factories');
        });
    });
});






