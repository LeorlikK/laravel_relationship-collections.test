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
        Schema::create('many_to_many_interim', function (Blueprint $table) {
            $table->id();
            $table->foreignId('many_first_interim')->constrained('many_to_many_first', 'primary_first');
            $table->foreignId('many_second_interim')->constrained('many_to_many_second', 'primary_second');
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
        Schema::dropIfExists('many_to_many_interim');
    }
};
