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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('valor', 10, 2);
            $table->string('cpf', 14);
            $table->string('arquivo')->nullable();
            $table->string('arquivo_nome')->nullable();
            $table->enum('status', ['em_processamento', 'aprovada', 'negada'])->default('em_processamento');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
