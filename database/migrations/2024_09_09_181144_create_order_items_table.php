<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->integer('article_id');
            $table->string('title');
            $table->integer('table')->nullable();
            $table->integer('sifra')->nullable();
            $table->float('price');
            $table->string('printer');
            $table->float('total')->nullable();
            $table->integer('quantity');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
