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
            $table->integer('product_category_id')->unsigned()->index();
            $table->string('name', 255);
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('fake_quantity');
            $table->string('images', 255);
            $table->longText('long_desc', 255);
            $table->longText('short_desc', 255);
            $table->string('is_feature', 255);
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
