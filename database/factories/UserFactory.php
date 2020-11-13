<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserBloodGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            #'user_id' => UserBloodGroup::factory(),
            'name' => $this->faker->name,
            'father_name' => 'Father',
            'mother_name' => 'Mother',
        ];
    }
    public function configure()
    {
        return $this->afterMaking(function (User $user) {
            //
        })->afterCreating(function (User $user) {
            //
        });
    }
}
