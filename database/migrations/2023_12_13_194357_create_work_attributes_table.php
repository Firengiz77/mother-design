<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_attributes', function (Blueprint $table) {
            $table->id();
            $table->text('work_id');
            $table->text('file_1');
            $table->text('file_2')->nullable();
            $table->text('file_3')->nullable();

            $table->text('type_1');
            $table->text('type_2')->nullable();
            $table->text('type_3')->nullable();
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
        Schema::dropIfExists('work_attributes');
    }
};
