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
        Schema::create('accounting_documents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->boolean('electronic_billing');
            $table->enum('tax_type', ['in_price', 'out_price']);
            $table->decimal('sale_percentage', 5, 2);
            $table->string('print_document', 255);
            $table->string('prefix_numbering', 255);
            $table->integer('start_numbering');
            $table->boolean('mail_shipping');

            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_documents');
    }
};
