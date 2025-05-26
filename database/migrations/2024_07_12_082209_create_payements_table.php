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
        Schema::create('payements', function (Blueprint $table) {
            $table->id();
            $table->integer('id_eleve');
            $table->foreign('id_eleve')->references('id')->on('eleves');
            $table->decimal('total_pay',8,2);
            $table->decimal('montant_pay',8,2);
            $table->decimal('reste_pay',8,2);
            $table->string('description');
            $table->date('date_pay')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};
