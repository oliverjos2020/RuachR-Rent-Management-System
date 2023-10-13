<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->bigInteger('phone');
            $table->string('email');
            $table->string('company_name')->nullable();
            $table->string('state');
            $table->string('street');
            $table->string('apartment')->nullable();
            $table->string('town');
            $table->string('postcode')->nullable();
            $table->integer('product_id');
            $table->integer('qty');
            $table->integer('user');
            $table->integer('owner');
            $table->integer('status')->default(0);
            $table->decimal('amount');
            $table->integer('fulfillment')->default(0);
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
