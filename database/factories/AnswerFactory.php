<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
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
            'question_id' => null,
            'answer_text' => fake()->sentence(),
            'is_correct' => fake()->boolean(),
            'image' => $faker->imageUrl(),
            'matching_pair' => null,
            'order_position' => null,
            'metadata' => null,
        ];
    }

    /**
     * Configure the factory state for a multiple choice answer.
     *
     * @return static
     */

    public function multipleChoice()
    {
        return $this->state(fn() => [
            'is_correct' => fake()->boolean(),
        ]);
    }

    /**
     * Configure the factory state for a true
     * Configure the factory state for a true/false answer.
     *
     * @return static
     */
    public function trueFalse()
    {
        return $this->state(fn() => [
            'answer_text' => fake()->randomElement(['True', 'False']),
            'is_correct' => fake()->boolean(),
        ]);
    }

    /**
     * Configure the factory state for a matching answer.
     *
     * @return static
     */
    public function matching()
    {
        return $this->afterCreating(function (Answer $answer) {
            // Periksa apakah pasangan sudah ada dan tipe metadata cocok
            if (is_null($answer->matching_pair)) {
                $expectedType = $answer->metadata['type'] === 'domain' ? 'kodomain' : 'domain';

                // Cari jawaban yang belum memiliki pasangan dan memiliki tipe metadata yang sesuai
                $unmatchedAnswer = Answer::where('question_id', $answer->question_id)
                    ->whereNull('matching_pair')
                    ->where('id', '!=', $answer->id)
                    ->where('metadata->type', $expectedType)
                    ->first();

                if ($unmatchedAnswer) {
                    // Pasangkan jawaban dengan pasangan yang ditemukan
                    $unmatchedAnswer->update(['matching_pair' => $answer->id]);
                    $answer->update(['matching_pair' => $unmatchedAnswer->id]);
                }
            }
        });
    }

    /**
     * Configure the factory state for an ordering answer.
     *
     * @return static
     */
    public function ordering()
    {
        return $this->state(fn() => [
            'is_correct' => true,
            'order_position' => fake()->randomDigitNotNull(),
        ]);
    }

    /**
     * Configure the factory state for a short answer.
     *
     * @return static
     */
    public function shortAnswer()
    {
        return $this->state(fn() => [
            'answer_text' => fake()->word(),
        ]);
    }
}
