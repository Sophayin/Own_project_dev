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
        Schema::create('loan_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('languages')->nullable(true);;
            $table->string('phone')->nullable(true);
            $table->string('contact_person')->nullable(true);
            $table->string('telegram')->nullable(true);
            $table->longText('description')->nullable(true);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_companies');
    }
};
