<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertismentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisment', function (Blueprint $table) {
            $table->increments('adv_id')->index();
            $table->integer('job_id')->index()->default('0');
            $table->integer('enquiry_id')->index()->default('0');
            $table->integer('client_id')->index()->default('0');
            $table->integer('branch_id')->index()->default('0');
            $table->integer('adv_date')->default('0');
            $table->integer('adv_publish_date')->default('0');
            $table->integer('adv_cost')->default('0');
            $table->string('adv_cost_check_attachment',255)->default('');
            $table->integer('dtp_cost')->default('0');
            $table->string('dtp_cost_check_attachment',255)->default('0');
            $table->string('adv_media1')->default('');
            $table->string('adv_media2')->default('');
            $table->string('adv_media3')->default('');
            $table->string('adv_check_recipt',255)->default('');
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
        Schema::dropIfExists('advertisment');
    }
}
