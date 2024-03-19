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
        Schema::create('cashDisbursement', function (Blueprint $table) {
            $table->id();
            $table->decimal('openingBalance',20,2);
            $table->string('desc');
            $table->decimal('inflow',20,2);
            $table->decimal('outflow',20,2);
            $table->decimal('balance',20,2);
            $table->string('docs');
            $table->string('status')->default('Pending');
            $table->string('club');
            $table->string('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashDisbursement');
    }
    // public $timestamps = false;
};
