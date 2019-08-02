<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('removes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('removed_id');
            $table->string('removed_type');

            $table->bigInteger('remover_id')->nullable();
            $table->string('remover_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('removers');
    }
}
