<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferences extends Migration
{
    public function up()
    {
        Schema::table('repositories', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('goods', function (Blueprint $table) {


            $table->foreign('repository_id')->references('id')->on('repositories')->onDelete('cascade');
        });


        Schema::table('bills', function (Blueprint $table) {

            $table->foreign('good_id')->references('id')->on('goods')->onDelete('cascade');

            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');

            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

        });

        Schema::table('inventories', function (Blueprint $table) {


            $table->foreign('repository_id')->references('id')->on('repositories')->onDelete('cascade');
        });

        Schema::table('parters', function (Blueprint $table) {


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


    }

    public function down()
    {
        Schema::table('repositories', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['user_id']);
        });

        Schema::table('goods', function (Blueprint $table) {
            // 移除外键约束
            $table->dropForeign(['repository_id']);
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign(['good_id']);
            $table->dropForeign(['inventory_id']);
            $table->dropForeign(['receiver_id']);
            $table->dropForeign(['owner_id']);
        });

        Schema::table('inventories', function (Blueprint $table) {
            $table->dropForeign(['repository_id']);
        });

         Schema::table('parters', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

    }
}
