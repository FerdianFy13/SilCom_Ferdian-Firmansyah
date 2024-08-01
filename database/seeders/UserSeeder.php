<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'email' => 'adminsilcom123@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('admin123'),
                'nik' => '3510160202020003',
                'phone' => '081234567891',
                'address' => 'Jl. Semarang 29, Semarang',
                'role' => 'Admin',
            ],
            [
                'name' => 'Ferdian Firmansyah',
                'email' => 'ferdianfy13@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('ferdian123'),
                'nik' => '3510160202020004',
                'phone' => '081234567892',
                'address' => 'Jl. Semarang 19, Semarang',
                'role' => 'Customer',
            ],
            [
                'name' => 'Yusuf Dian',
                'email' => 'yusufdian@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('yusuf123'),
                'nik' => '3510160202020005',
                'phone' => '081234567893',
                'address' => 'Jl. Semarang 39, Semarang',
                'role' => 'Customer',
            ],
        ];

        foreach ($data as $user) {
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => $user['email_verified_at'],
                'password' => $user['password'],
                'nik' => $user['nik'],
                'phone' => $user['phone'],
                'address' => $user['address'],
            ]);

            if ($user['role'] === 'Admin') {
                $newUser->assignRole('Admin');
                $newUser->givePermissionTo('Active');
            } else {
                $newUser->assignRole('Customer');
                $newUser->givePermissionTo('Active');
            }
        }
    }
}
