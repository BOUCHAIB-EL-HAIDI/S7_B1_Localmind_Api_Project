<?php
1: 
2: namespace Tests\Feature\Api;
3: 
4: use App\Models\Question;
5: use App\Models\User;
6: use Illuminate\Foundation\Testing\RefreshDatabase;
7: use Tests\TestCase;
8: 
9: class FavoriteTest extends TestCase
10: {
11:     use RefreshDatabase;
12: 
13:     public function test_user_can_toggle_favorite_on_question()
14:     {
15:         $user = User::factory()->create();
16:         $question = Question::factory()->create();
17:         $this->actingAs($user, 'sanctum');
18: 
19:         // Favorite
20:         $response = $this->postJson("/api/questions/{$question->id}/favorite");
21:         $response->assertStatus(200)
22:                  ->assertJson(['message' => 'Question ajoutée aux favoris']);
23:         $this->assertTrue($user->favorites()->where('question_id', $question->id)->exists());
24: 
25:         // Unfavorite
26:         $response = $this->postJson("/api/questions/{$question->id}/favorite");
27:         $response->assertStatus(200)
28:                  ->assertJson(['message' => 'Question retirée des favoris']);
29:         $this->assertFalse($user->favorites()->where('question_id', $question->id)->exists());
30:     }
31: 
32:     public function test_user_can_list_favorites()
33:     {
34:         $user = User::factory()->create();
35:         $questions = Question::factory()->count(3)->create();
36:         foreach ($questions as $q) {
37:             $user->favorites()->attach($q->id);
38:         }
39: 
40:         $this->actingAs($user, 'sanctum');
41: 
42:         $response = $this->getJson('/api/favorites');
43: 
44:         $response->assertStatus(200)
45:                  ->assertJsonCount(3, 'data');
46:     }
47: }
