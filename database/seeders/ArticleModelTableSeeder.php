<?php

namespace Database\Seeders;

use App\Models\ArticleModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ArticleCount = (int) $this->command->ask('How many dummy blogs would you want to add', 200);

         // get all users
        $users = User::all();
          // blog post with user name
        ArticleModel::factory()->times($ArticleCount)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;

            $post->save();
        });

    }
}
