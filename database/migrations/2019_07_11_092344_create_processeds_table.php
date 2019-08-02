<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcessedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('processed_id');
            $table->string('processed_type');

            $table->bigInteger('processor_id')->nullable();
            $table->string('processor_type')->nllable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processeds');
    }
}
