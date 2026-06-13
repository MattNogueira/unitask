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
        Schema::create('notificacao', function (Blueprint $table) {
            $table->id();
            $table->text('mensagem');
            $table->dateTime('dataEnvio');
            $table->boolean('lida')->default(false);
            $table->foreignId('id_atividade')->constrained('atividade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacao');
    }
};
