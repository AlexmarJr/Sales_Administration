<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_client');
            $table->string('product');
            $table->decimal('original_price', 19, 2);
            $table->decimal('current_price', 19, 2);
            $table->decimal('latest_paiment', 19, 2)->nullable($value = true);
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
        Schema::dropIfExists('vendas');
    }
}
