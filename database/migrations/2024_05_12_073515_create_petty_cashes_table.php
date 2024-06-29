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
        Schema::create('petty_cashes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('responsible_id');
            $table->decimal('income', 10, 2);
            $table->decimal('expense', 10, 2);
            $table->decimal('initial', 10, 2);
            $table->enum('status', ['abierta', 'cerrada', 'desactivada']);

            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_cashes');
    }
};
