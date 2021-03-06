<?php

namespace Database\Seeders;

use App\Models\ArticleModel;
use App\Models\Comments;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = ArticleModel::all();

        if ($posts->count() === 0) {
            $this->command->info('There are no blogs, no comment will be added');
            return;
        }
        $CommentCount = (int) $this->command->ask('How many dummy comments would you want to add', 2000);

        $users = User::all();

// creating random
        Comments::factory()->times($CommentCount)->make()->each(function ($comment) use ($posts, $users) {
            $comment->article_model_id = $posts->random()->id;
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

    }
}
