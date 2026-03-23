<?php
1: 
2: namespace Tests\Feature\Api;
3: 
4: use App\Models\Question;
5: use App\Models\Response;
6: use App\Models\User;
7: use Illuminate\Foundation\Testing\RefreshDatabase;
8: use Tests\TestCase;
9: 
10: class ResponseTest extends TestCase
11: {
12:     use RefreshDatabase;
13: 
14:     public function test_authenticated_user_can_respond_to_question()
15:     {
16:         $user = User::factory()->create();
17:         $question = Question::factory()->create();
18:         $this->actingAs($user, 'sanctum');
19: 
20:         $response = $this->postJson("/api/questions/{$question->id}/responses", [
21:             'content' => 'This is a test response.',
22:         ]);
23: 
24:         $response->assertStatus(201);
25:         $this->assertDatabaseHas('responses', [
26:             'content' => 'This is a test response.',
27:             'question_id' => $question->id,
28:             'user_id' => $user->id,
29:         ]);
30:     }
31: 
32:     public function test_owner_can_update_response()
33:     {
34:         $user = User::factory()->create();
35:         $response_obj = Response::factory()->create(['user_id' => $user->id]);
36:         $this->actingAs($user, 'sanctum');
37: 
38:         $response = $this->putJson("/api/responses/{$response_obj->id}", [
39:             'content' => 'Updated response content.',
40:         ]);
41: 
42:         $response->assertStatus(200);
43:         $this->assertDatabaseHas('responses', ['content' => 'Updated response content.']);
44:     }
45: 
46:     public function test_non_owner_cannot_update_response()
47:     {
48:         $user = User::factory()->create();
49:         $otherUser = User::factory()->create();
50:         $response_obj = Response::factory()->create(['user_id' => $user->id]);
51:         $this->actingAs($otherUser, 'sanctum');
52: 
53:         $response = $this->putJson("/api/responses/{$response_obj->id}", [
54:             'content' => 'Updated response content.',
55:         ]);
56: 
57:         $response->assertStatus(403);
58:     }
59: 
60:     public function test_question_owner_can_mark_response_as_solution()
61:     {
62:         $user = User::factory()->create();
63:         $question = Question::factory()->create(['user_id' => $user->id]);
64:         $response_obj = Response::factory()->create(['question_id' => $question->id]);
65:         
66:         $this->actingAs($user, 'sanctum');
67: 
68:         $response = $this->postJson("/api/responses/{$response_obj->id}/solution");
69: 
70:         $response->assertStatus(200);
71:         $this->assertTrue($response_obj->fresh()->is_solution);
72:     }
73: 
74:     public function test_non_question_owner_cannot_mark_response_as_solution()
75:     {
76:         $user = User::factory()->create();
77:         $otherUser = User::factory()->create();
78:         $question = Question::factory()->create(['user_id' => $user->id]);
79:         $response_obj = Response::factory()->create(['question_id' => $question->id]);
80:         
81:         $this->actingAs($otherUser, 'sanctum');
82: 
83:         $response = $this->postJson("/api/responses/{$response_obj->id}/solution");
84: 
85:         $response->assertStatus(403);
86:     }
87: }
