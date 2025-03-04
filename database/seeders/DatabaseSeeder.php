<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $secretKey = config('database.connections.mysql.encryption_key');

        $users = [
            [
                'email' => 'josebaduma@gmail.com',
                'password' => 'Z30sB4d1l4#',
                'name' => 'Jose Badilla',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'email' => $user['email'],
                'password' => DB::raw("AES_ENCRYPT('{$user['password']}', '{$secretKey}')"),
                'name' => $user['name'],
            ]);
        }
    }
}
