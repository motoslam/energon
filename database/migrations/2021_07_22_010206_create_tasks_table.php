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
            $table->foreignId('user_id'); // кому поставлена задача
            $table->foreignId('company_id')->nullable();
            $table->foreignId('task_status_id')->default(1);
            $table->string('name');
            $table->text('content')->nullable();
            $table->enum('priority', ['regular', 'average', 'critical'])->defult('regular');
            $table->boolean('from_admin')->default(false);  // задача от руководителя
            $table->boolean('need_confirm')->default(false); // Подтв. рук-м, ставится автоматически
            $table->integer('timer')->nullable(); // время выполнения - часов
            $table->timestamp('deadline_at')->nullable(); // срок задачи
            $table->timestamp('closed_at')->nullable(); // дата завершения
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
