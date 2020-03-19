<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_user');
            $table->string('name_product');
            $table->decimal('buy_price', 19, 2)->nullable($value = true);
            $table->decimal('sell_price', 19, 2)->nullable($value = true);
            $table->integer('quantity');
            $table->longText('description')->nullable($value = true);
            $table->boolean('status')->nullable($value = true);
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
        Schema::dropIfExists('estoques');
    }
}
