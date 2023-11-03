<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRejectionTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rejection_type', function (Blueprint $table) {
            $table->integer('rejection_type_id');
            $table->integer('machine_id');
            $table->integer('company_id');
            $table->string('rejection_type_name',255);
            $table->integer('rejection_type_status');
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
        Schema::dropIfExists('rejection_type');
    }
}
