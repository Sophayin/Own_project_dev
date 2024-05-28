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
        Schema::create('shop_agencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->default(null);
            $table->foreignId('shop_id')->default(null);
            $table->string('creator')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_agencies');
    }
};
