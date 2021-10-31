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
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->foreignId('status_id')->constrained('order_statuses')->onDelete('no action');
                $table->foreignId('user_id')->constrained('users')->onDelete('no action');
                $table->string('name', 35);
                $table->string('surname', 50);
                $table->string('phone', 18);
                $table->string('email');
                $table->string('country', 50);
                $table->string('city', 50);
                $table->string('address');
                $table->float('total')->comment('total price');
                $table->timestamps();
            });
        }
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
