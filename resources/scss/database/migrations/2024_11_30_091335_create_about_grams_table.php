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
        Schema::create('about_grams', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('district');
            $table->string('taluka');
            $table->string('gram');
            $table->text('about_gram');
            $table->string('path')->nullable(); // Store the file path (nullable since it's optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_grams');
    }
};
