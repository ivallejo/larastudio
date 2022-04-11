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
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('product')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->decimal('unit_price', 5, 2)->nullable();
            $table->decimal('quantity', 5, 2)->nullable();
            // $table->string('percent_employee')->nullable();
            $table->decimal('percent_employee', 5, 2)->nullable();
            $table->boolean('status')->default(true);
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
