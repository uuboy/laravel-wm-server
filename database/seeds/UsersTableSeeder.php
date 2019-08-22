<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'L&L',
            'email' => '441778293@qq.com',
            'password' => bcrypt('secret'),
            'weapp_openid' => 'oK14f5XJRGpFptwhYYXKsJQaKCOo',
            'weixin_session_key' => 'c9nN8VhzE3DrgGTGAeBS7w=='
        ]);

        $user = User::find(1);
        $user->assignRole('Founder');
    }
}
