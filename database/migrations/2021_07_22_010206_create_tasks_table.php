<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');                               /** Исполнитель задачи */
            $table->foreignId('senior_id')->nullable();                 /** Постановщик задачи */
            $table->foreignId('company_id')->nullable();                /** Контрагент */
            $table->foreignId('task_status_id')->default(1);      /** Статус задачи */
            $table->string('name');                                     /** Название (заголовок) */
            $table->text('content')->nullable();                        /** Описание */
            $table->enum('priority_id', [
                'regular', 'average', 'critical'
            ])->defult('regular');                                              /** Приоритет задачи */
            $table->boolean('need_confirm')->default(false);     /** Требуется проверка выполнения  */
            $table->timestamp('deadline_at')->nullable();               /** Дедлайн: дата и время */
            $table->timestamp('started_at')->nullable();                /** Дата и время устан.стат.В работе */
            $table->timestamp('closed_at')->nullable();                 /** Фактическая дата завершения */
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
        Schema::dropIfExists('tasks');
    }
}
