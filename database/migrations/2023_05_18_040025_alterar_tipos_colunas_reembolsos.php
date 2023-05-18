<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterarTiposColunasReembolsos extends Migration
{
    public function up()
    {
        Schema::table('reembolsos', function (Blueprint $table) {
            $table->string('centrocusto_id')->change();
            $table->string('usuario_id')->change();
        });
    }

    public function down()
    {
        Schema::table('reembolsos', function (Blueprint $table) {
            $table->integer('centrocusto_id')->change();
            $table->integer('usuario_id')->change();
        });
    }
}

