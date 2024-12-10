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
        Schema::create('gharpatti_panipattis', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('district');
            $table->string('taluka');
            $table->string('gram');
            $table->string('username');
            $table->enum('type', ['gharpatti', 'panipatti']);
            $table->string('amount_type');
            $table->enum('paid_type', ['cash', 'online', 'rtgs', 'check']);
            $table->decimal('paid_amount', 10, 2);
            $table->datetime('paid_date');
            $table->decimal('remaining_amount', 10, 2)->nullable();
            $table->boolean('send_bill')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gharpatti_panipattis');
    }
};
