<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('invoice_id')->index();
            $table->string('invoice_code',255)->default('');
            $table->integer('client_id')->index()->default('0');
            $table->integer('invoice_date')->default('0');
            $table->integer('from_date')->default('0');
            $table->integer('to_date')->default('0');
            $table->string('amount',255)->default('');
            $table->string('invoice_status',255)->default('');
            $table->string('invoice_remark',255)->default('');
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
        Schema::dropIfExists('invoice');
    }
}
