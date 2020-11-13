<?php

namespace Database\Factories;

use App\Models\UserBloodGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserBloodGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserBloodGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    const BLOOD_GROUP = array(
        'A+',
        'A-',
        'B+',
        'B-',
        'O+',
        'O-',
    );

    public function definition()
    {
        return [
            #'user_id' => ,
            'blood_group' => self::BLOOD_GROUP[array_rand(self::BLOOD_GROUP)],
            //
        ];
    }
}
