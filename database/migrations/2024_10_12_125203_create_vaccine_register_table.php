<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vaccine_register', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('center_id');
            $table->dateTime('scheduled_at')->nullable();
            $table->string('nid', 20)->unique();
            $table->foreign('user_id', 'vaccine_register_fk_1')->on('users')->references('id');
            $table->foreign('center_id', 'vaccine_register_fk_2')->on('vaccine_center')->references('id');
            $table->timestamps();
            $table->index(['nid']); // index for search optimizations
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_register');
    }
};
