<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name_en'=>$this->faker->jobTitle,
            'name_ar'=>$this->faker->jobTitle,
            'active'=>$this->faker->boolean(50),
        ];
    }
}
