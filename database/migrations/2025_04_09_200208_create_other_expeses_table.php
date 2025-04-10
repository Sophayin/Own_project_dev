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
        Schema::create('other_expeses', function (Blueprint $table) {
            $table->id();
            $table->string('cloth')->nullable(true);
            $table->string('cloth_price')->nullable(true);
            $table->string('accessary')->nullable(true);
            $table->string('accessary_price')->nullable(true);
            $table->string('event')->nullable(true);
            $table->string('event_expense')->nullable(true);
            $table->string('taxi')->nullable(true);
            $table->string('taxi_fee')->nullable(true);
            $table->string('remark')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_expeses');
    }
};