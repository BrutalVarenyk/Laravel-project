<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->foreignId('category_id')
                    ->nullable()
                    ->constrained('categories')
                    ->onDelete('SET NULL');
                $table->string('title')->unique();
                $table->longText('description');
                $table->string('short_description', 150);
                $table->string('SKU', 35)->unique();
                $table->float('price')->startingValue(1);
                $table->integer('discount')->nullable();
                $table->unsignedInteger('in_stock')->default(0);
                $table->string('thumbnail');
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
        Schema::dropIfExists('products');
    }
}
