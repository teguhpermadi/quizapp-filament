<?php

namespace Database\Factories;

use App\Enums\QuestionTypeEnum;
use App\Enums\ScoreEnum;
use App\Enums\TimerEnum;
use App\Models\Question;
use App\Models\Teacher;
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
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        return [
            'question' => fake()->realText(),
            'question_type' => fake()->randomElement(QuestionTypeEnum::class),
            'image' => $faker->imageUrl(),
            'explanation' => fake()->realText(50),
            'score' => fake()->randomElement(ScoreEnum::class),
            'timer' => fake()->randomElement(TimerEnum::class),
            'level' => fake()->randomElement(['easy', 'medium', 'hard']),
            'teacher_id' => Teacher::get()->random()->id,
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Question $question) {
            $question->attachTag('tag-'. strval(fake()->numberBetween(1, 3)));
        });
    }
}
