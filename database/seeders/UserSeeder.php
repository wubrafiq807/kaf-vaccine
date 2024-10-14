<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', UserRole::SuperAdmin)
            ->first();
        if (!$user) {
            User::factory()->create([
                'role' => 'SUPER_ADMIN',
                'email' => 'test@example.com',
            ]);
        }
    }
}
