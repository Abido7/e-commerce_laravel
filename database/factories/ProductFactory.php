<?php

namespace Database\Factories;

use App\Models\Product;
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
        static $i = 0;
        $i++;
        return [
            'name' => json_encode([
                'en' => $this->faker->word(),
                'ar' => $this->faker->word(),
            ]),
            'description' => json_encode([
                'en' => $this->faker->text(500),
                'ar' => $this->faker->text(500),
            ]),
            'img' => "products/$i.png",
            'price' => $this->faker->randomNumber(2),
            'pices_no' => $this->faker->numberBetween(1, 20),
            'is_active' => 1,
        ];
    }
}