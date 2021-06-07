<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int) $this->command->ask('How many dummy Users would you want to add? Remember the default password is password', 20), 5);

        User::factory()->AdminUser()->create();
        User::factory()->times($userCount)->create();

    }
}
