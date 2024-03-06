<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actor_film', function (Blueprint $table) {
            $table->bigInteger('actor_id')->unsigned()->nullable(false);
            $table->foreign('actor_id') -> references('id')->on('actor');

            $table->bigInteger('film_id')->unsigned()->nullable(false);
            $table->foreign('film_id') -> references('id')->on('film');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_film');
    }
};
