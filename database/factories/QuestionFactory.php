<?php

namespace Database\Factories;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $mode1 = Question::class;


    public function definition()
    {
        return [
            'quiz_id' => rand(1,10),
            'question'=> $this->faker->sentence(rand(3,7)),
            'answer1' => $this->faker->sentence(rand(1,2)),
            'answer2' => $this->faker->sentence(rand(1,2)),
            'answer3' => $this->faker->sentence(rand(1,2)),
            'answer4' => $this->faker->sentence(rand(1,2)),
            'correct_answer' => 'answer'.rand(1,4)
            


        ];
    }
}
