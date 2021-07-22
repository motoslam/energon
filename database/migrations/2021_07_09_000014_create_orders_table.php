<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');                        /** Контрагент */
            $table->foreignId('user_id');                           /** Пользователь, оформивший заказ */
            $table->string('internal_id');                          /** Номер заказа из договора */
            $table->decimal('total', 10, 2);           /** Сумма заказа */
            $table->date('order_date')->nullable();                 /** Дата заказа (если пусто то created_at) */
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
        Schema::dropIfExists('orders');
    }

}
