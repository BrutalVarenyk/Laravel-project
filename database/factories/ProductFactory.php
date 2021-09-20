<?php

namespace Database\Factories;

use App\Models\Product;
use Faker\Provider\it_IT\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->sentence(12, true),
            'short_description' => $this->faker->sentence(rand(1, 3), true),
            'SKU' => Person::taxId(),
            'price' => $this->faker->randomFloat(2, 5, 200),
            'in_stock' => $this->faker->numberBetween(0, rand(2, 10)),
            'discount' => $this->faker->numberBetween(0, rand(5, 25)),
            'thumbnail' => $this->faker->imageUrl(400, 600)
        ];
    }
}
