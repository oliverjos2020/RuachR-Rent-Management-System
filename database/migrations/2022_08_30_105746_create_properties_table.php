<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->index();
            $table->string('title');
            // $table->text('short_description');
            $table->text('description');
            $table->integer('category_id')->unsigned()->index();
            $table->integer('location_id')->unsigned()->index();
            $table->integer('amount');
            $table->string('featured');
            $table->string('featured_image');
            $table->integer('offer');

            //$table->integer('photo_id')->constrained()->onDelete('cascade')->unsigned()->index()->unique();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
