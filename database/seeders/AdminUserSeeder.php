<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buat Role jika belum ada
        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleUser = Role::firstOrCreate(['name' => 'User']);

        // User Admin
        $user = User::create([
            'name' => 'Admin',
            'whatsapp_number' => '6281222535789',
            'password' => Hash::make('admin123'),
        ]);
        $user->assignRole($roleAdmin);

        // User Shakira
        $user2 = User::create([
            'name' => 'Shakira',
            'whatsapp_number' => '6285311054081',
            'password' => Hash::make('admin123'),
        ]);
        $user2->assignRole($roleUser);
    }
}
