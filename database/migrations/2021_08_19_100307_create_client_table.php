<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('client_id')->index();
            $table->string('user_id',255)->default('');
            $table->string('company_name',50)->default('');
            $table->string('client_city',50)->default('');
            $table->string('client_state',50)->default('');
            $table->string('client_zipcode',50)->default('');
            $table->string('client_country',50)->default('');
            $table->string('client_email',50)->default('');
            $table->string('client_mobile',50)->default('');
            $table->string('client_officeno',50)->default('');
            $table->string('client_address',255)->default('');
            $table->string('contact_person',50)->default('');
            $table->string('contact_person_mobile',20)->default('');
            $table->string('contact_person_email',20)->default('');
            $table->string('client_logo',255)->default('');
            $table->string('client_status',255)->default('');
            $table->string('client_remark',255)->default('');
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
        Schema::dropIfExists('client');
    }
}
