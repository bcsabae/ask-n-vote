<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Guest;
use App\Models\Question;
use App\Models\SessionCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Guest $guest;
    protected Question $question;
    protected SessionCode $sessionCode;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->sessionCode = SessionCode::factory()->forUser($this->user)->create();
        $this->guest = Guest::factory()->forSession($this->sessionCode)->create();
        $this->question = Question::factory()->forGuest($this->guest)->withZeroUpvotes()->create();
    }

    protected function guest_auth_data(): array
    {
        return [
            "guest_id" => $this->guest->id
        ];
    }

    protected function login_as_guest()
    {
        session($this->guest_auth_data());
    }

    /** @test */
    public function questions_index_route_gives_403_by_default()
    {
        $response = $this->get(route('questions.index'));

        $response->assertRedirectToRoute('q-and-a.login.form');
    }

    /** @test */
    public function questions_index_route_gives_200_when_guest_authenticated()
    {
        $this->login_as_guest();

        $response = $this->get(route('questions.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function post_to_questions_store_handles_happy_validation_case()
    {
        $this->login_as_guest();

        $response = $this->post(route('questions.store'), [
            'question_text' => 'What is Laravel?'
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('questions', [
            'question_text' => 'What is Laravel?',
            'guest_id' => $this->guest->id,
        ]);
    }

    /** @test */
    public function post_to_questions_store_handles_validation_errors()
    {
        $this->login_as_guest();

        $response = $this->post(route('questions.store'), [
            'question_text' => ''
        ]);

        $response->assertSessionHasErrors('question_text');
    }

    /** @test */
    public function delete_to_questions_destroy_gives_redirect_by_default()
    {
        $response = $this->delete(route('questions.destroy', $this->question));

        $response->assertRedirectToRoute('q-and-a.login.form');
    }

    /** @test */
    public function authenticated_user_can_delete_own_session_question()
    {
        $this->actingAs($this->user);

        $response = $this->delete(route('questions.destroy', $this->question));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('questions', ['id' => $this->question->id]);
    }

    /** @test */
    public function authenticated_user_cannot_delete_other_session_question()
    {
        $otherUser = User::factory()->create();
        $otherSessionCode = SessionCode::factory()->forUser($otherUser)->create();
        $otherGuest = Guest::factory()->forSession($otherSessionCode)->create();
        $otherQuestion = Question::factory()->forGuest($otherGuest)->create();

        $this->actingAs($this->user);

        $response = $this->delete(route('questions.destroy', $otherQuestion));

        $response->assertStatus(403);
        $this->assertDatabaseHas('questions', ['id' => $otherQuestion->id]);
    }

    /** @test */
    public function guest_can_delete_own_question()
    {
        $this->login_as_guest();

        $response = $this->delete(route('questions.destroy', $this->question));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('questions', ['id' => $this->question->id]);
    }

    /** @test */
    public function guest_cannot_delete_other_question()
    {
        $otherUser = User::factory()->create();
        $otherSessionCode = SessionCode::factory()->forUser($otherUser)->create();
        $otherGuest = Guest::factory()->forSession($otherSessionCode)->create();
        $otherQuestion = Question::factory()->forGuest($otherGuest)->create();

        $this->login_as_guest();

        $response = $this->delete(route('questions.destroy', $otherQuestion));

        $response->assertStatus(403);
        $this->assertDatabaseHas('questions', ['id' => $otherQuestion->id]);
    }

    /** @test */
    public function post_to_questions_upvote_works()
    {
        $this->login_as_guest();

        $this->post(route('questions.upvote', $this->question));

        $this->question->refresh();

        $this->assertEquals(1, $this->question->upvotes);
        $this->assertContains($this->question->id, session()->get('upvoted', []));
    }

    /** @test */
    public function post_to_questions_downvote_works()
    {
        $this->login_as_guest();
        $this->question->upvotes = 1;
        $this->question->save();
        session()->push('upvoted', $this->question->id);

        $this->put(route('questions.downvote', $this->question));

        $this->question->refresh();

        $this->assertEquals(0, $this->question->upvotes);
        $this->assertNotContains($this->question->id, session()->get('upvoted', []));
    }

    /** @test */
    public function patch_to_questions_update_needs_user_authentication()
    {
        $this->login_as_guest();

        $response = $this->patch(route('questions.update', $this->question), ['is_answered' => true]);

        $response->assertRedirectToRoute('login');
    }

    /** @test */
    public function patch_to_questions_update_validates_correctly_happy_case()
    {
        $this->actingAs($this->user);

        $response = $this->patch(route('questions.update', $this->question), ['is_answered' => true]);

        $response->assertStatus(302);
        $this->assertTrue($this->question->fresh()->is_answered === 1);
    }

    /** @test */
    public function patch_to_questions_update_validates_correctly_sad_case()
    {
        $this->actingAs($this->user);

        $response = $this->patch(route('questions.update', $this->question), ['is_answered' => 'string']);

        $response->assertSessionHasErrors('is_answered');
    }
}
?>
