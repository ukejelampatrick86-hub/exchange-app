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
    Schema::create('rates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('currency_from')->constrained('currencies');
        $table->foreignId('currency_to')->constrained('currencies');
        $table->decimal('rate', 15, 6); // Taux de change
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('rates');
}

};
