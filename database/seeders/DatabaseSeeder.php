<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $super = new User();
		$super->name = 'Admin';
		$super->email = 'admin@melhorvisao.com';
		$super->password = bcrypt('12345678');
        $super->admin = 'Sim';
		$super->save();
    }
}
