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
            $table->string('name', 100);
            $table->string('img',)->default('product.jpg');
            $table->integer('price');
            $table->integer('quantity');
            $table->text('des',);
            $table->integer('category');
            $table->integer('subcategory');
            $table->integer('added_by');
            $table->integer('action')->default(1);
            $table->integer('discount')->default(null);
            $table->integer('notification_quantity')->default(null);
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
    }
}
