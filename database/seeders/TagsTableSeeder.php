<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Science', 'Machine Learning', 'Data Science', 'Coding', 'Data Structures', 'Programming']);
        $tags->each(function ($tagName) {
            $tag = new Tags();
            $tag->name = $tagName;
            $tag->save();
        });

    }
}
