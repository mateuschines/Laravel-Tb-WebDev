<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            //faz referenceia da tabela id da tabela user onDelete se apagar usuario ele apaga todos posts 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //colocar nome da tabela _ id se eu deletar isso apaga tudo vinculado a ele
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title', 250);
            $table->text('description');
            $table->date('date');
            $table->time('hour');
            $table->boolean('featured')->default(false);
            //é um comentario
            $table->enum('status', ['A', 'R'])->default('A')->comment('A-> Ativo postado, R-> Rascunho, não postado');
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
        Schema::dropIfExists('posts');
    }
}
