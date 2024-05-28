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
        Schema::create('agency_histories', function (Blueprint $table) {
            $table->id();
            $table->string('agency_code')->nullable(true);
            $table->foreignId('agency_id')->nullable(true);
            $table->foreignId('position_id')->nullable(true);
            $table->foreignId('leader_id')->nullable(true);
            $table->string('leader_code')->nullable(true);
            $table->foreignId('promoter_id')->nullable(true);
            $table->string('status')->nullable(true);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agency_histories');
    }
};
