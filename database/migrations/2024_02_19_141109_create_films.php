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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->nullable(false);
            $table->year('release_year', 4)->nullable();
            $table->smallInteger('length')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->enum('rating', ['G','PG','PG-13','R','NC-17'])->default('G');
            $table->bigInteger('language_id')->unsigned()->nullable(false);
            $table->string('special_features', 200)->nullable();
            $table->string('image', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
