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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->foreignId('from_currency_id')->constrained('currencies');
        $table->foreignId('to_currency_id')->constrained('currencies');
        $table->decimal('amount_from', 15, 2);
        $table->decimal('amount_to', 15, 2);
        $table->decimal('rate', 15, 6);
        $table->timestamps();
        $table->softDeletes(); // dans une migration

    });
}

public function down(): void
{
    Schema::dropIfExists('transactions');
}

};
