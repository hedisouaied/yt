<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->text,
            'surface' => $this->faker->numberBetween(2, 10),
            'facade' => $this->faker->numberBetween(2, 10),
            'rdc' => $this->faker->numberBetween(2, 10),
            'petage' => $this->faker->numberBetween(2, 10),
            'brand_id' => $this->faker->randomElement(Brand::pluck('id')->toArray()),
            'cat_id' => $this->faker->randomElement(Category::where('is_parent', 1)->pluck('id')->toArray()),
            'child_cat_id' => $this->faker->randomElement(Category::where('is_parent', 0)->pluck('id')->toArray()),
            'photo' => $this->faker->imageUrl('400', '200'),
            'price' => $this->faker->numberBetween(100, 1000),
            'conditions' => $this->faker->randomElement(['sale', 'rent']),
            'fond' => $this->faker->randomElement(['fdc', 'dab', 'mc', 'lp']),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'extraction' => $this->faker->randomElement(['yes', 'no']),
            'video' => $this->faker->word,
            'address' => $this->faker->word,
            'date_d' => $this->faker->date(),
            'ref' => $this->faker->word,

        ];
    }
}
