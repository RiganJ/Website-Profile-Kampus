<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'IT Support',
                'email' => 'it@ufdk.local',
                'role' => 'super_admin',
                'department' => 'IT',
                'password' => 'IT@UFDK2026!',
            ],
            [
                'name' => 'IT Admin 2',
                'email' => 'it2@ufdk.local',
                'role' => 'super_admin',
                'department' => 'IT',
                'password' => 'It2@UFDK2026!',
            ],
            [
                'name' => 'Rektor',
                'email' => 'rektor@ufdk.local',
                'role' => 'admin',
                'department' => 'Rektorat',
                'password' => 'Rektor@UFDK2026!',
            ],
            [
                'name' => 'Wakil Rektor',
                'email' => 'wakilrektor@ufdk.local',
                'role' => 'admin',
                'department' => 'Wakil Rektor',
                'password' => 'WakilRektor@UFDK2026!',
            ],
            [
                'name' => 'Kemahasiswaan',
                'email' => 'kemahasiswaan@ufdk.local',
                'role' => 'kemahasiswaan',
                'department' => 'Kemahasiswaan',
                'password' => 'Kemahasiswaan@UFDK2026!',
            ],
            [
                'name' => 'Media',
                'email' => 'media@ufdk.local',
                'role' => 'media',
                'department' => 'Media',
                'password' => 'Media@UFDK2026!',
            ],
            [
                'name' => 'CRM',
                'email' => 'crm@ufdk.local',
                'role' => 'crm',
                'department' => 'CRM',
                'password' => 'CRM@UFDK2026!',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'department' => $user['department'],
                    'password' => $user['password'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
