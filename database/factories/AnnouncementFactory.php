<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Announcement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoriesIds = Category::pluck('id');
        $usersIds = User::pluck('id');
        return [
            'title'=>$this->faker->sentence(1),
            'body'=>$this->faker->realText(rand(100,200)),
            'price'=>rand(10,100),
            'category_id'=>$categoriesIds->random(),
            'user_id'=>$usersIds->random()
        ];
    }
}
