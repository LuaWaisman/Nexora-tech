
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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id('id_solicitud');
            $table->unsignedBigInteger('id_solicitante');
            $table->string('asunto', 150);
            $table->text('descripcion');
            $table->string('tipo', 100);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->enum('estado', ['Pendiente', 'En proceso', 'Resuelta'])
                  ->default('Pendiente');

            $table->foreign('id_solicitante')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes');
    }
};
