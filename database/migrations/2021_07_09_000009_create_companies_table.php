<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();                           /** Ответственный менеджер */
            $table->foreignId('company_type_id')->default(1);             /** Тип контрагента */
            $table->foreignId('company_status_id')->default(1);           /** Статус контрагента */
            $table->foreignId('company_purchase_id')->default(1);         /** Тип закупки */
            $table->foreignId('potentiality_id')->default(3);             /** Потенциал контрагента */
            $table->foreignId('city_id');                                       /** Город */
            $table->string('legal')->nullable();                                /** Правовая форма организации */
            $table->string('name');                                             /** Название огранизации */
            $table->string('ssn', 13)->unique();                         /** Social Security Number, ИНН */
            $table->text('description')->nullable();                             /** Краткое описание организации, заметка */
            $table->string('address')->nullable();                               /** Адрес огранизации */

            /** Поля для статусов "Действующий" */

            $table->string('contract')->nullable();                             /** Номер договора */
            $table->string('specification')->nullable();                        /** Номер спецификации */
            $table->decimal('manager_bonus', 2, 2)->nullable();    /** Процент менеджера */
            $table->integer('working_hours')->nullable();                       /** Кол-во рабочих часов */
            $table->string('equipment')->nullable();                            /** Тип оборудования */

            /** Конец полей для статусов "Действующий" */

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
