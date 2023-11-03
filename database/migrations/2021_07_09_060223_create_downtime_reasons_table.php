<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDowntimeReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('downtime_reasons', function (Blueprint $table) {
            $table->integer('downtime_reasons_id');
            $table->integer('machine_id');
            $table->integer('company_id');
            $table->string('downtime_reasons_name',255);
            $table->integer('downtime_reasons_status');
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
        Schema::dropIfExists('downtime_reasons');
    }
}
