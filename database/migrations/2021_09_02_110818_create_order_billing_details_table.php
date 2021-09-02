<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_billing_details', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email',);
            $table->integer('division');
            $table->integer('district');
            $table->string('cookie');
            $table->string('address',);
            $table->integer('zip_code');
            $table->integer('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_billing_details');
    }
}
