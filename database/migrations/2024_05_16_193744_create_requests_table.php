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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_type');
            $table->unsignedInteger('request_id');
            $table->string('first_name', 510);
            $table->string('second_name', 510);
            $table->string('patronymic', 510) ->nullable();
            $table->string('group', 510);

            $table->index(['request_type', 'request_id']);
            $table->enum('status', ['wait_action', 'wait_send', 'archive'])->default('wait_action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
