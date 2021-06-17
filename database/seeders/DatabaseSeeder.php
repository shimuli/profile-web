<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Hello Developer, Do you want refresh the database?', true)) {
            $this->command->call('migrate:refresh');
            $this->command->info('Awesome! Database was refreshed');
        }
        $this->call([
            UserTableSeeder::class,
            ArticleModelTableSeeder::class,
            CommentsTableSeeder::class,
            TagsTableSeeder::class,
            ArticleModelTagsTableSeeder::class,
        ]);

    }
}
