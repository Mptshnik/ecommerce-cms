<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'default-user',
            'email' => 'cheburkov123@mail.ru',
            'password' => Hash::make('root'),
            'profile_image' => 'profile/images/Fkk8dEYs7Z1ve7FSB714D6lMhjoZvcS6srHoNsXQ.jpg'
        ]);
    }
}
