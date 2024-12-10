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
        Schema::create('annual_maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('district');
            $table->string('taluka');
            $table->string('gram');
            $table->integer('maintenance_year');
            $table->decimal('maintenance_amount', 15, 2);
            $table->decimal('remaining_amount', 15, 2);
            $table->string('payment_mode');
            $table->text('description')->nullable();
            $table->integer('current_population')->nullable();
            $table->enum('bill_status', ['pending', 'complete']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_maintenances');
    }
};
