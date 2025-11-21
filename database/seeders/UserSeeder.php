<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Superadmin
        $superadmin = User::firstOrCreate(
            ['email' => env('SUPERADMIN_EMAIL', 'superadmin@example.com')],
            [
                'name' => 'Super', 'surname' => 'Admin',
                'email_verified_at' => now(),
                'password' => Hash::make(env('SUPERADMIN_PASSWORD', 'ChangeMe123!')),
                'profile_photo' => 'superadmin.png',
                'job_title' => 'Company Owner',
                'phone_number' => '+99812345678',
            ]);
        $superadmin->is_root = true;
        $superadmin->save();
        $superadmin->assignRole('superadmin');

        // Create Admins
        $admins = [
            [
                'name' => 'Çingiz',
                'surname' => 'Tağılı',
                'email' => 'cingiz@mail.com',
                'profile_photo' => 'cingiz.png',
                'job_title' => 'Backend Developer',
            ],
            [
                'name' => 'Kənan',
                'surname' => 'Məmmədov',
                'email' => 'kenan@mail.com',
                'profile_photo' => 'kenan.png',
                'job_title' => 'Mobile Developer',
            ],
            [
                'name' => 'Pərvin',
                'surname' => 'Hüseynov',
                'email' => 'pervin@mail.com',
                'profile_photo' => 'pervin.png',
                'job_title' => 'Frontend Developer',
            ],
        ];

        foreach ($admins as $data) {
            $admin = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'profile_photo' => $data['profile_photo'],
                    'job_title' => $data['job_title'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('12345678'),
                    'phone_number' => '+99812345678',
                ]);
            $admin->assignRole('admin');
        }

        // Create User
        $user = User::firstOrCreate(
            ['email' => 'nicat@mail.com'],
            [
                'name' => 'Nicat',
                'surname' => 'Paşayev',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'profile_photo' => 'nicat.png',
                'job_title' => 'SQL Developer',
                'phone_number' => '+99812345678',
            ]);
        $user->assignRole('user');
    }
}
