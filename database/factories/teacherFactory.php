<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\teacher;
class teacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * 
     */
   
    public function definition()
    {
        return [
            'teacher_name'=>$this->faker->name()
        ];
    }
}
