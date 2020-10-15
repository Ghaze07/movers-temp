<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable(false);
            $table->unsignedBigInteger('author_id')->nullable(false);
            $table->string('language')->default('EN');
            $table->string('title');
            $table->text('content');
            $table->boolean('published')->default(true);
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('author_id')
                ->refernces('id')
                ->on('authors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
