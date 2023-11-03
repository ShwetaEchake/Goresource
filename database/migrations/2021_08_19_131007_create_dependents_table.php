<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependents', function (Blueprint $table) {
            $table->increments('dependent_id')->index();
            $table->integer('candidate_id')->index()->default('0');
            $table->string('first_name',255)->default('');
            $table->string('family_name',255)->default('');
            $table->string('dependent_relation',255)->default('');
            $table->string('dependent_mi',255)->default('');
            $table->string('occupation')->index()->default('');
            $table->string('birth_date')->index()->default('');
            $table->string('gender')->index()->default('');
            $table->tinyinteger('status')->index()->default('0');
            $table->string('emp')->default('');
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
        Schema::dropIfExists('dependents');
    }
}
