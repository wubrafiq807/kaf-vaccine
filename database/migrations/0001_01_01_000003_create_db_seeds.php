<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // dbdum for locations info like division, district, upazila, unions tables
        $path = 'database/sql/information.sql';
        DB::unprepared(file_get_contents($path));
    }
};
