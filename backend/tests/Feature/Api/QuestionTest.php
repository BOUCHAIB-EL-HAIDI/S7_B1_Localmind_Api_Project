<?php

namespace Tests\Feature\Api;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_questions()
    {
        Question::factory()->count(3)->create();

        $response = $this->getJson('/api/questions');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_authenticated_user_can_create_question()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/questions', [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'location' => 'Test Location',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('questions', ['title' => 'Test Title']);
    }

    public function test_owner_can_update_question()
    {
        $user = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $user->id]);
        $this->actingAs($user, 'sanctum');

        $response = $this->putJson("/api/questions/{$question->id}", [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
            'location' => 'Updated Location',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('questions', ['title' => 'Updated Title']);
    }

    public function test_non_owner_cannot_update_question()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $user->id]);
        $this->actingAs($otherUser, 'sanctum');

        $response = $this->putJson("/api/questions/{$question->id}", [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
            'location' => 'Updated Location',
        ]);

        $response->assertStatus(403);
    }
}
