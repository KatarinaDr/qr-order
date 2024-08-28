<?php

use App\Models\Article;
use App\Models\Printer;
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
        Schema::create('article_printer', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Article::class);
            $table->foreignIdFor(Printer::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_printer');
    }
};
