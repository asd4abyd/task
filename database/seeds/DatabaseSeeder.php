<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'name' => 'admin',
            'email' => 'admin@mytask.local',
            'password' => bcrypt('123456'),
            'is_admin' => 1,
    ]);
    }
}
