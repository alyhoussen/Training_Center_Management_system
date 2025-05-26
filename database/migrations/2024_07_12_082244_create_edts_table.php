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
        Schema::create('edts', function (Blueprint $table) {
            $table->id();
            $table->string('jour');
            $table->string('heur')->nullable();
            $table->string('nom_formation')->nullable();
            $table->string('niveau')->nullable();
            $table->integer('nom_enseignant')->nullable();
            $table->date('date_edt');
            $table->string('centre')->default('ANDOHANILAKAKA');
            $table->string('type')->default('cours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edts');
    }
};
