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
        Schema::create('reembolsos', function (Blueprint $table) {
            $table->id();
            $table->string('valor', 50)->nullable();
            $table->date('data')->nullable();
            $table->string('gasto_id')->nullable();
            $table->string('centrocusto_id')->nullable();
            $table->string('observacao', 100)->nullable();
            $table->string('usuario_id')->nullable();
            $table->string('forma_pgt', 25)->nullable();
            $table->string('parcelas', 15)->nullable();
            $table->string('image')->nullable();
            $table->string('corporativo')->nullable();
            $table->string('status')->nullable();
            $table->string('tipo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reembolsos');
    }
};
