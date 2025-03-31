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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('breakfast')->nullable(true);
            $table->string('lunch')->nullable(true);
            $table->string('dinner')->nullable(true);
            $table->string('amount_coffee')->nullable(true);
            $table->string('coffee_price')->nullable(true);
            $table->string('gasoline')->nullable(true);
            $table->string('gasoline_price')->nullable(true);
            $table->string('party_expend')->nullable(true);
            $table->string('remark')->nullable(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
