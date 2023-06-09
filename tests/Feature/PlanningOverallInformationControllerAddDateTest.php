<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PlanningOverallInformationControllerAddDateTest extends TestCase
{
    use RefreshDatabase; // Reset the database for each test

    /** @test */
    public function it_adds_dates_to_a_project()
    {
        $this->withoutExceptionHandling();

        // Create necessary models or data for the test
        $project = Project::factory()->create();
        $projectId = $project->id_project;
        $startDate = '2023-06-01';
        $endDate = '2023-06-30';

        // Send a request to the add date endpoint
        $response = $this->post(route('planning_overall.add-date', $projectId), [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        // Assert that the project was updated with the new dates
        $this->assertDatabaseHas('project', [
            'id_project' => $projectId,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        // Assert a successful response
        $response->assertRedirect(route('planning.index', ['id' => $projectId, 'project' => $project]));
    }

    /** @test */
    public function it_does_not_add_dates_to_a_project_with_invalid_dates()
    {
        $this->withoutExceptionHandling();

        // Create necessary models or data for the test
        $project = Project::factory()->create();
        $projectId = $project->id_project;
        $startDate = '2023-06-30';
        $endDate = '2023-06-01';

        // Send a request to the add date endpoint with invalid dates
        $response = $this->post(route('planning_overall.add-date', $projectId), [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        // Assert that the project was not updated with the invalid dates
        $this->assertDatabaseMissing('project', [
            'id_project' => $projectId,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        // Assert a validation error response with a specific error message
        $response->assertSessionHasErrors(['end_date'], 'The end date must be after the start date.');

    }
}
