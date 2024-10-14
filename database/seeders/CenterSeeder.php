<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', UserRole::SuperAdmin)
            ->first();
        if (!$user) {
            App::abort(500, 'Please create System super admin first');
        }

        if (empty(VaccineCenter::count())) {
            // Add center seeder , initially all center address will go to for Chitalmari, bagerhat
            for ($i = 0; $i < 10; $i++) {
                $centers[] = [
                    'name' => 'Center ' . ($i + 1),
                    'limit_per_day' => 1000 + ($i * 5),
                    'district_id' => 28, //  bagerhat district as per districts seeds table
                    'upazila_id' => 223, // chitalmari thana
                    'union_id' => 117, // chitalmari thana sador post office,
                    'address' => 'Moc Address',
                    'created_by' => $user->id
                ];
            }
            VaccineCenter::insert($centers);
        }
    }
}
