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
            $table->string('title', 255)->nullable(false);
            $table->text('description')->nullable();
            $table->year('release_year')->nullable();
            $table->bigInteger('language_id')->unsigned()->nullable(false);
            $table->tinyInteger('original_language_id')->unsigned()->nullable();
            $table->tinyInteger('rental_duration')->unsigned()->nullable(false)->default(3);
            $table->decimal('rental_rate', 4, 2)->nullable(false)->default(4.99);
            $table->smallInteger('length')->unsigned()->nullable();
            $table->decimal('replacement_cost', 5, 2)->nullable(false)->default(19.99);
            $table->enum('rating', ['G','PG','PG-13','R','NC-17'])->default('G');
            $table->set('special_features', ['Trailers','Commentaries','Deleted Scenes','Behind the Scenes'])->nullable();
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
