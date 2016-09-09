<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material__lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('material_name');
            $table->integer('amount');
            $table->string('stock');
            $table->string('order');
            $table->integer('tender_id');
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
        Schema::drop('material__lists');
    }
}
