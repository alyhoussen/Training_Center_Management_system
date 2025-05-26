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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id('id_enseignant');
            $table->string('name');
            $table->string('surname');
            $table->date('datenaiss');
            $table->string('telephone');
            $table->string('image');
            $table->string('cin');
            $table->string('email')->nullable();
            $table->integer('id_formation');
            $table->integer('id_centre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enseignants');
    }
};
