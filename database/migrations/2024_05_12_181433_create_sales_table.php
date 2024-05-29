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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['in process', 'charged', 'cancelled', 'deleted']);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('seller_id');
            $table->decimal('net_amount', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->unsignedBigInteger('accounting_document_id');
            $table->decimal('total', 10, 2);
            $table->decimal('change', 10, 2);
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('petty_cashes_id');

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('accounting_document_id')->references('id')->on('accounting_documents')->onDelete('cascade');
            $table->foreign('petty_cashes_id')->references('id')->on('petty_cashes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
