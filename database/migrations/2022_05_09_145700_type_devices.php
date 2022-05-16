<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_devices', function (Blueprint $table) {
            $table->id();
            $table->string('title_device');
            $table->string('slug')->unique();
//            $table->integer('id_additional_data')->unsigned();
            $table->timestamps();//updated_at , create_at
            $table->softDeletes();//deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_devices');
    }
}
