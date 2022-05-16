<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TypeMemory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_memory', function (Blueprint $table) {
            $table->id();
            $table->integer('type_memory')->unsigned();
            $table->string('title');
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
        Schema::dropIfExists('type_memory');
    }
}
