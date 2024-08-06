<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 100);
            $table->string('email', 100)->nullable();
            $table->string('ruc', 20)->nullable();
            $table->string('main_address', 200)->nullable();
            $table->string('main_phone', 20)->nullable();
            $table->string('secondary_address', 200)->nullable();
            $table->string('secondary_phone', 20)->nullable();
            $table->string('photo', 255)->default('default.jpg');
            $table->enum('status', ['activa', 'inactiva', 'mantenimiento', 'eliminado'])->default('activa');
            $table->enum('branch_type', ['central', 'sucursal', 'otro'])->default('sucursal');
            $table->text('notes')->nullable();
            $table->json('data')->nullable();
            $table->uuid('cun')->unique();
            $table->timestamps();
            $table->softDeletes();

            // Indices adicionales
            $table->index(['company_name', 'email', 'ruc', 'main_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
