<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeDevicesFirms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firms_type_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('firms_id')->unsigned();
            $table->unsignedBigInteger('type_devices_id')->unsigned();

            $table->timestamps();
            $table->softDeletes();
            //связываю поле user_id с id  в таблице users
            //user_id we connect with this (filed) -> to filed(id) in table users
            $table->foreign('firms_id')->references('id')->on('firms');
            //связываю category_id с id в таблице blog_categories
            $table->foreign('type_devices_id')->references('id')
                ->on('type_devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firms_type_devices');
    }
}
