<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title_product');
            $table->bigInteger('code_product')->unsigned();
            $table->foreignId('categories_id')->constrained('categories');
            $table->string('merk')->nullable();
            $table->float('discount')->nullable();
            $table->bigInteger('buy_price')->unsigned();
            $table->bigInteger('sell_price')->unsigned();
            $table->integer('stock');
            $table->softDeletes();
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
        Schema::dropIfExists('products');
        // Schema::disableForeignKeyConstraints();
        // Schema::enableForeignKeyConstraints();
    }
}
