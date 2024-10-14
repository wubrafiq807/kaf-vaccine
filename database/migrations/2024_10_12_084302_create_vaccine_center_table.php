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
        Schema::create('vaccine_center', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('limit_per_day')->default(0);
            $table->integer('district_id');
            $table->integer('upazila_id');
            $table->integer('union_id');
            $table->string('address',255)->nullable(); // add line for road no , house no , gram/vilage ets
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('created_by', 'vaccine_center_fk_1')->on('users')->references('id');
            $table->foreign('updated_by', 'vaccine_center_fk_2')->on('users')->references('id');
            $table->foreign('district_id', 'vaccine_center_fk_3')->on('districts')->references('id');
            $table->foreign('upazila_id', 'vaccine_center_fk_4')->on('upazilas')->references('id');
            $table->foreign('union_id', 'vaccine_center_fk_5')->on('unions')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccine_center');
    }
};
