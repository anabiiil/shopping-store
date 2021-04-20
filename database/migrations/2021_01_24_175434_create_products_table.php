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
            $table->string('name');
            $table->integer('external_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->longText('description');
            $table->decimal('discount',8,2);
            $table->text('price');
            $table->string('cover')->default('default.png');
            $table->enum('status', ['active', 'un_active'])->default('active');
            $table->enum('type', ['admin', 'user'])->default('admin');
            $table->text('color');
            $table->text('code');
            $table->text('care');
            $table->tinyInteger('feature_item')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
