<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tax_office')->unique(); // Код ИФНС
            $table->string('fias_id')->unique(); // Код ФИАС
            $table->string('name');
            $table->string('full_name');
            $table->string('type');
            $table->string('federal_district')->nullable();
            $table->string('short_fd')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
