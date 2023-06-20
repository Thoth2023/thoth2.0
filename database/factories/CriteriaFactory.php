<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\User;
use App\Models\SearchStrategy;
use App\Models\Criteria;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class CriteriaFactory extends Factory
{

    protected $model = Criteria::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_project' => Project::factory()->create()->id_project,
            'description' => $this->faker->paragraph,
            'id' => $this->faker->word,
            'type' => $this->faker->sentence,
            'pre_selected' => '1',
        ];
    }

    public function withSearchStrategy()
    {
        return $this->has(SearchStrategy::factory());
    }
}
