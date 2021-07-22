<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id');
            $table->smallInteger('tax_office');                 // Код ИФНС
            $table->string('type')->nullable();                 // Тип населенного пункта
            $table->string('name');                             // Название города, напр. Москва
            $table->string('full_name');                        // Полное написание адреса по ФИАС
            $table->string('postal_code')->nullable();          // Почтовый индекс
            $table->string('fias_id')->unique();                // ФИАС (для определения уникальности)
            $table->string('geo_lat')->nullable();
            $table->string('geo_lon')->nullable();
            $table->string('federal_district')->nullable();     // Федеральный округ
            $table->string('foundation_year')->nullable();      // Год основания
            $table->smallInteger('timezone_offset');            // Смещение времени от UTC
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
