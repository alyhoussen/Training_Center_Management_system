<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('datenaiss');
            $table->string('telephone');
            $table->string('image');
            $table->string('CIN')->nullable();
            $table->string('email')->nullable();
            $table->string('level')->nullable();
            $table->timestamp('date_inscription')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('id_formation')->nullable();
            $table->string('enseignant')->nullable();
            $table->string('id_centre')->nullable(); 
            $table->string('id_session')->nullable();   
            $table->string('certificate')->default('Pending');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eleves');
    }
};
