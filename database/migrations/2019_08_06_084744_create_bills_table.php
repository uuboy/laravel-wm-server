<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sort');
            $table->bigInteger('num');
            $table->bigInteger('good_id')->unsigned()->default(0)->index();
            $table->bigInteger('inventory_id')->unsigned()->default(0)->index();
            $table->bigInteger('receiver_id')->unsigned()->default(0)->index();
            $table->bigInteger('owner_id')->unsigned()->default(0)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
