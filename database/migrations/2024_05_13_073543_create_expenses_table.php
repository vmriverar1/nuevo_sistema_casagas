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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('responsible', 255);
            $table->decimal('total', 10, 2);
            $table->decimal('change', 10, 2);
            $table->string('photograph', 255);
            $table->text('justification');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('petty_cashes_id');

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('petty_cashes_id')->references('id')->on('petty_cashes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
