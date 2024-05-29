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
        // Crear tabla de usuarios
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('password', 255);
            $table->string('email', 100)->unique();
            $table->enum('document_type', ['dni', 'ruc', 'pasaporte'])->default('dni');
            $table->string('document', 50)->unique();
            $table->string('phone', 20)->default('No disponible');
            $table->string('address', 200)->default('No disponible');
            $table->date('birthday')->nullable();
            $table->string('photo', 255)->default('default.jpg');

            $table->enum('profile', ['usuario', 'cliente', 'proveedor'])->default('usuario');

            $table->datetime('last_login')->nullable();
            $table->json('data')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
