<?php

namespace Database\Factories;

use App\Models\ArticleModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
              'title' => $this->faker->sentence(10),
            'content'=> $this->faker->paragraphs(5,true)
        ];
    }
}
