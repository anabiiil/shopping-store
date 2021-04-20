<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
   
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->integer('external_id');
            $table->enum('status', ['approved', 'pending' , 'decline'])->default('pending');
            $table->enum('type', ['admin', 'vendor'])->default('admin');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
