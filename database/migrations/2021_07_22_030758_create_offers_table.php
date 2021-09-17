<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');                /** Контрагент */
            $table->foreignId('user_id');                   /** Менеджер */
            $table->foreignId('contact_id')->nullable();    /** Контактное лицо */
            $table->string('internal_id');                  /** Внешний ID заявки (в документах компании) */
            $table->text('data')->nullable();               /** Комментарий */
            $table->date('offer_date')->nullable();         /** Дата заявки */
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
        Schema::dropIfExists('offers');
    }
}
