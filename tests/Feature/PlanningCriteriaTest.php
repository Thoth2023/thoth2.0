<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Criteria;
use App\Models\Project;

class PlanningCriteriaTest extends TestCase
{

    //Teste de comunicação com a rota
    public function test_status_criteria(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $project = Project::factory()->create();
        $criteria = Criteria::factory()->create();

        $response = $this->get('/planning/'.$criteria->id_project.'/criteria');

        $response->assertStatus(200);
    }

    //teste de criação de criteria
    public function test_add_criteria(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $project = Project::factory()->create();
        $criteria = Criteria::factory()->create();

        $response = $this->post('/planning/criteria/add' , [
            'id_project' => $project->id_project,
            'description' => 'New Criteria',
            'id' => $criteria->id,
            'type' => 'Inclusion',
            'pre_selected' => '1',
        ]);

        $response->assertRedirect('/planning/'.$project->id_project.'/criteria');
    }

    //teste de criação de criteria com ID ja exitente
    public function test_add_criteria_id_ex(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->post('/planning/criteria/add', $criteria->toArray());

        $response->assertStatus(302);
    }

    //teste de criação de criteria com ID vazio
    public function test_add_criteria_void_id(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->post('/planning/criteria/add',[
            'id_project' => $criteria->id_project,
            'description' => 'New Criteria',
            'id' => $criteria->id,
            'type' => 'Inclusion',
            'pre_selected' => '1',
        ]);

        $response->assertStatus(302);
    }

    //teste para editar a criteria
    public function test_edit_criteria(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->put('/planning/criteria/'.$criteria->id_criteria, [
            'id_project'=>$criteria->id_project,
            'id'=> ''.$criteria->id.'1',
            'description'=>'aaaaaa',
            'type'=>'Exclusion',
            'pre_selected'=>'1'
        ]);

        $response->assertRedirect('/planning/'.$criteria->id_project.'/criteria');
    }

    //teste para editar a criteria com id existente
    public function test_edit_criteria_id_ex(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->put('/planning/criteria/'.$criteria->id_criteria, [
            'id_project'=>$criteria->id_project,
            'id'=> ''.$criteria->id,
            'description'=>'aaaaaa',
            'type'=>'Exclusion',
            'pre_selected'=>'1'
        ]);

            $response->assertStatus(302);
    }

    //teste para editar a criteria com id vazio
    public function test_edit_criteria_void_id(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->put('/planning/criteria/'.$criteria->id_criteria, [
            'id_project'=>$criteria->id_project,
            'id'=> '',
            'description'=>'aaaaaa',
            'type'=>'Exclusion',
            'pre_selected'=>'1'
        ]);

        $response->assertStatus(302);
    }

    //teste para editar o pre selected criteria
    public function test_edit_pre_selected_criteria(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->put('/planning/criteria/'.$criteria->id_criteria, [
            'id_project'=>$criteria->id_project,
            'id'=> ''.$criteria->id.'1',
            'description'=>'aaaaaa',
            'type'=>'Exclusion',
            'pre_selected'=>'0'
        ]);

        $response->assertRedirect('/planning/'.$criteria->id_project.'/criteria');
    }

    //Teste de editar o selected criteria com o campo vazio
    public function test_edit_pre_selected_criteria_void(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->put('/planning/criteria/'.$criteria->id_criteria, [
            'id_project'=>$criteria->id_project,
            'id'=> ''.$criteria->id.'1',
            'description'=>'aaaaaa',
            'type'=>'Exclusion',
            'pre_selected'=>''
        ]);

        $response->assertStatus(302);
    }

    public function test_delete_criteria(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@argon.com',
            'password' => 'secret',
        ]);

        $criteria = Criteria::factory()->create();

        $response = $this->delete('/criteria/'.$criteria->id_criteria);

        $response->assertRedirect('/planning/'.$criteria->id_project.'/criteria');
    }


}
