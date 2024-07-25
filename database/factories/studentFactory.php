<?php

namespace Database\Factories;

use App\Models\student;
use Illuminate\Database\Eloquent\Factories\Factory;

class studentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {       $data= new student;
        return [
            
            "student_name" =>$this->faker->name(),
            "class_teacher_id" =>rand(1,10),
            "class" =>$this->faker->randomElement(['FY-BSCIT','SY-BSCIT','TY-BSCIT']),
            "admission_date" =>$this->faker->date(),
            "Yearly_fees" =>rand(5000,50000)
            
        ];
    }
}
