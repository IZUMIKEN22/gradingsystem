<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Clear existing admins (optional - be careful with this!)
        // DB::table('admins')->truncate();
        
        Admin::create([
            'name' => 'Super Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $this->command->info('Admin user created successfully!');
    }
}