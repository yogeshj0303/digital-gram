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
        Schema::create('grams', function (Blueprint $table) {
            $table->id();
            $table->string('gram_name');
            $table->string('state')->nullable();
        $table->string('district')->nullable();
        $table->string('taluka')->nullable();
        $table->string('village')->nullable();
        $table->string('address')->nullable();
        $table->string('pin_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grams');
    }
};
