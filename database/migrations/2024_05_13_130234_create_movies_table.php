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
        Schema::create('movies', function(Blueprint $table){
            $table->string('num_movie')->primary();
            $table->string('name');
            $table->integer('duration');
            $table->string('synopsis');
            
            $table->string('release');
            $table->timestamps();
            $table->string('num_director');
            $table->foreign('num_director')->references('num_director')->on('directors')->onDelete('cascade');
        });

        Schema::create('actor_movie', function(Blueprint $table){
            $table->integer('num_movie');
            $table->integer('num_actor');
            $table->timestamps();
            $table->foreign('num_movie')->references('num_movie')->on('movies')->onDelete('cascade');
            $table->foreign('num_actor')->references('num_actor')->on('actors')->onDelete('cascade');
            $table->unique(['num_actor','num_movie']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('actor_movie');     
    }
};
