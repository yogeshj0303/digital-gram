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
        Schema::create('gram_bills', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('district');
            $table->string('taluka');
            $table->string('gram');
            $table->integer('population')->unsigned();
            $table->decimal('first_time_bill_amount', 10, 2)->nullable();
            $table->date('quatation_date')->nullable();
            $table->date('bill_date')->nullable();
            $table->string('reference_number')->nullable();
            $table->decimal('maintenance_amount', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('payment_mode')->nullable();
            $table->date('next_maintenance_date')->nullable();
            $table->string('bill_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gram_bills');
    }
};
