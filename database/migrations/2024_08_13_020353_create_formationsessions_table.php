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
        Schema::create('formationsessions', function (Blueprint $table) {
            $table->id();
            $table->date('start');
            $table->date('end');
            $table->date('echeance');
            $table->string('formation');
            $table->string('state')->default('Pending');
            $table->string('niveau');
            $table->decimal('frais');
            $table->string('centre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formationsessions');
    }
};
