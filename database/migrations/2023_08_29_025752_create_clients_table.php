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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gender')->nullable(true);
            $table->string('age')->nullable(true);
            $table->string('profile')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('facebook')->nullable(true);
            $table->string('email')->nullable(true);
            $table->foreignId('user_id')->nullable(true);
            $table->foreignId('address_id')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};