<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiaryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiary', function (Blueprint $table) {
            $table->increments('beneficiary_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->string('beneficiary_type',255)->default('');
            $table->string('beneficiary_name',255)->default('');
            $table->string('beneficiary_family_name',255)->default('');
            $table->string('beneficiary_mi',255)->default('');
            $table->integer('beneficiary_birth_date')->default('0');
            $table->string('beneficiary_mobile');
            $table->text('beneficiary_address');
            $table->string('beneficiary_zip',255)->default('');
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
        Schema::dropIfExists('beneficiary');
    }
}
