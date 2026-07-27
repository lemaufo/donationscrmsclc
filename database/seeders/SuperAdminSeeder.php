<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('email', env('SUPERADMIN_EMAIL'))->exists()) {
            $this->command->info('Superadmin ya existe, omitiendo.');
            return;
        }

        User::create([
            'name'     => env('SUPERADMIN_NAME', 'Leiber Trejo'),
            'email'    => env('SUPERADMIN_EMAIL', 'ventas@teknologix.mx'),
            'password' => Hash::make(env('SUPERADMIN_PASSWORD')),
            'role'     => 'superadmin',
        ]);

        $this->command->info('Superadmin creado correctamente.');
    }
}
