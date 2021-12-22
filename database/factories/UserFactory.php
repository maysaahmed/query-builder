<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class UserFactory extends Factory
{
    public $timestamps = false;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $first_name = $this->faker->firstName($gender ='male'|'female');
        $last_name = $this->faker->lastName();
        $full_name = $first_name . ' ' . $last_name;
        return [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'full_name' => $full_name,
            'gender' => $this->faker->randomElement(['male', 'female']) ,
            'age' => $this->faker->numberBetween( 10, 80),
            'num_msgs' => $this->faker->randomNumber(),
            'creation_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }



}
