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
        Schema::create('payment_requirement', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_methods_id');
            $table->unsignedBigInteger('requirement_id');

            $table->foreign('payment_methods_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('requirement_id')->references('id')->on('requirements')->onDelete('cascade');

            $table->primary(['payment_methods_id', 'requirement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_requirement');
    }
};
