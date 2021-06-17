<?php

namespace Database\Seeders;

use App\Models\ArticleModel;
use App\Models\Tags;
use Illuminate\Database\Seeder;

class ArticleModelTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tags::all()->count();
        if ($tagCount === 0) {
            $this->command->info("No tags found, skipping assigning");
            return;
        }

        $howManyMin = (int) $this->command->ask('Minimum tags on blog posts', 0);
        $howManyMax = min((int) $this->command->ask('Maximum tags on blog posts', $tagCount), $tagCount);

        ArticleModel::all()->each(function (ArticleModel $post) use ($howManyMin, $howManyMax) {
            $take = random_int($howManyMin, $howManyMax);
            $tags = Tags::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);
        });

    }
}
