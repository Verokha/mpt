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
        Schema::create('request_characteristics', function (Blueprint $table) {
            $table->id();
            $table->string('semester');
            $table->date('birth_date');
            $table->string('school', 510);
            $table->year('end_school');
            $table->year('start_mpt');
            $table->string('responsibilities');
            $table->string('whereNeeded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_characteristics');
    }
};
