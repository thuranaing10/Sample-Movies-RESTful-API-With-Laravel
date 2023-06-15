<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('summary');
            $table->string('cover_image');
            $table->unsignedBigInteger('genre_id')->nullable();
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->double('imdb_ratings');
            $table->string('pdf_link');
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
        Schema::dropIfExists('movies');
    }
}
