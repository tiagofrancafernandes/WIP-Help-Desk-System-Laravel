<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        static::initialAdminUsers();
        $this->call([
            CustomerSeeder::class,
        ]);
    }

    public static function initialAdminUsers()
    {
        $adminUsers = [
            [
                'email' => 'admin@mail.com',
                'name' => 'Admin',
                'password' => Hash::make('power@123'),
            ]
        ];

        foreach ($adminUsers as $adminUser) {
            $user = User::updateOrCreate([
                'email' => $adminUser['email'],
            ], $adminUser);
        }
    }
}
