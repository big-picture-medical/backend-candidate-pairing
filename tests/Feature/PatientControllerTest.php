<?php

namespace Tests\Feature;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_requires_authentication()
    {
        $response = $this
            ->json('POST', '/api/patients', [
                'first_name' => 'The',
                'last_name' => 'Terminator',
            ]);

        $response->assertUnauthorized();
    }

    public function test_it_creates_a_patient()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('POST', '/api/patients', [
                'first_name' => 'Sarah',
                'last_name' => 'Connor',
                'date_of_birth' => '1963-05-13',
                'email' => 'sarah.conner@example.com',
            ]);

        $response
            ->assertCreated()
            ->assertExactJson([
                'data' => [
                    'first_name' => 'Sarah',
                    'last_name' => 'Connor',
                    'date_of_birth' => '1963-05-13',
                    'email' => 'sarah.conner@example.com',
                ],
        ]);
    }

    public function test_it_shows_a_patient()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('GET', "/api/patients/{$patient->id}");

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'date_of_birth' => $patient->date_of_birth->format('Y-m-d'),
                    'email' => $patient->email,
                ],
            ]);
    }

    public function test_it_lists_patients()
    {
        $user = User::factory()->create();
        Patient::factory()->times(3)->create();

        $response = $this
            ->actingAs($user)
            ->json('GET', '/api/patients');

        $response
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    [
                        'first_name',
                        'last_name',
                        'date_of_birth',
                        'email',
                    ]
                ]
            ]);
    }

    public function test_it_updates_a_patient()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create([
            'email' => null,
        ]);

        $response = $this
            ->actingAs($user)
            ->json('PATCH', "/api/patients/{$patient->id}", [
                'email' => 'sarah.connor@example.com',
            ]);

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'first_name' => $patient->first_name,
                    'last_name' => $patient->last_name,
                    'date_of_birth' => $patient->date_of_birth->format('Y-m-d'),
                    'email' => 'sarah.connor@example.com',
                ],
            ]);
    }

    public function test_it_prevents_emptying_fields()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('PATCH', "/api/patients/{$patient->id}", [
                'first_name' => '',
            ]);

        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors('first_name');
    }

    public function test_it_prevents_deleting_patients()
    {
        $user = User::factory()->create();
        $patient = Patient::factory()->create();

        $response = $this
            ->actingAs($user)
            ->json('DELETE', "/api/patients/{$patient->id}");

        $response
            ->assertStatus(Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
