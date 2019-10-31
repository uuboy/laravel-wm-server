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
            'weapp_openid' => 'ojzvF5N4zbwcQjpDoG_8z7Y1DAp8',
            'weixin_session_key' => '9EEw4Br0nZUdUIbElKIFYg=='
        ]);

        $user = User::find(1);
        $user->assignRole('Founder');
    }
}
