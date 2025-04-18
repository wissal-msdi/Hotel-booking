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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Room title
            $table->text('description'); // Room description
            $table->decimal('price_per_night', 8, 2); // Room price
            $table->integer('available_rooms'); // Number of rooms available
            $table->timestamps(); // created_at and updated_at    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
