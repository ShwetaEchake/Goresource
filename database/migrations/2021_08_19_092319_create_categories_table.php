<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id')->index();
            $table->string('category_name',255)->default('');
            $table->integer('parent_category_id')->index()->default('0');
            $table->tinyinteger('status')->default('0');
            $table->integer('created_by')->default('0');
            $table->integer('created_date')->default('0');
            $table->integer('updated_date')->default('0');
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
        Schema::dropIfExists('categories');
    }
}
