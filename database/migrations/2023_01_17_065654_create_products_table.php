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
            $table->integer('store_id')->unsigned()->nullable();
            $table->string('brand')->nullable();
            $table->string('name');
            $table->decimal('sale_price', 20, 6)->nullable();
            $table->decimal('purchase_price', 20, 6)->nullable();
            $table->integer('quantity')->unsigned()->default(0)->nullable();
            $table->string('model_number')->nullable();
            $table->string('mpn')->nullable();
            $table->longtext('description')->nullable();
            $table->string('slug')->unique();
            $table->text('meta_title')->nullable();
            $table->longtext('meta_description')->nullable();
            $table->bigInteger('sale_count')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('allow_inspection')->default(false)->nullable();

            $table->timestamps();

            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
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
