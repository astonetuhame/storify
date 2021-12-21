<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['short', 'long']);
        if ($type == 'short') {
            $body = $this->faker->paragraph();
        } else {
            $body = $this->faker->text(200);
        }

        return [
            //
            'user_id' => $this->faker->numberBetween(1, 3),
            'title' => $this->faker->unique()->lexify('??????????'),  //to follow validation for title to have min:10
            //    'title' => $this->faker->unique()->word(),
            'body' => $body,
            'type' => $type,
            'status' => $this->faker->boolean(),
        ];
    }
}
