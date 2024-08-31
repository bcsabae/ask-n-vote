<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\SessionCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class SessionCodeControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected SessionCode $sessionCode;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->sessionCode = SessionCode::factory()->forUser($this->user)->create();
    }

    /** @test */
    public function route_sessions_needs_user_authentication()
    {
        $response = $this->get(route('sessions'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function route_sessions_renders_fine_when_authenticated()
    {
        $this->actingAs($this->user);

        $response = $this->get(route('sessions'));

        $response->assertStatus(200);
    }

    /** @test */
    public function sessions_dashboard_renders_ok_for_user_owned_session_else_gives_403()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('sessions.dashboard', $this->sessionCode));
        $response->assertStatus(200);

        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);
        $response = $this->get(route('sessions.dashboard', $this->sessionCode));
        $response->assertStatus(403);
    }

    /** @test */
    public function post_to_sessions_new_happy_case_with_title()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('sessions.new'), ['title' => 'New Session']);
        $response->assertStatus(302);

        $this->assertDatabaseHas('session_codes', [
            'title' => 'New Session',
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function post_to_sessions_new_happy_case_without_title()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('sessions.new'));
        $response->assertStatus(302);

        $name = $this->user->name;
        $id = SessionCode::where('user_id', $this->user->id)->count();
        $title = "{$name}'s session #{$id}";

        $this->assertDatabaseHas('session_codes', [
            'title' => $title,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    public function post_to_sessions_new_sad_validation_case_too_long()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('sessions.new'), ['title' => str_repeat('a', 257)]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function post_to_sessions_new_sad_validation_case_not_unique()
    {
        $this->actingAs($this->user);

        $response = $this->post(route('sessions.new'), ['title' => $this->sessionCode->title]);
        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function patch_to_sessions_update_happy_validation_case()
    {
        $this->actingAs($this->user);

        $response = $this->patch(route('sessions.update', $this->sessionCode), ['is_active' => false]);

        $response->assertStatus(302);
        $this->assertFalse($this->sessionCode->fresh()->is_active === 1);
    }

    /** @test */
    public function patch_to_sessions_update_sad_validation_case_too_short_code()
    {
        $this->actingAs($this->user);

        $response = $this->patch(route('sessions.update', $this->sessionCode), ['session_code' => 'short']);

        $response->assertSessionHasErrors('session_code');
    }

    /** @test */
    public function patch_to_sessions_update_only_user_for_that_session_can()
    {
        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);

        $response = $this->patch(route('sessions.update', $this->sessionCode), ['is_active' => false]);

        $response->assertStatus(403);
    }

    /** @test */
    public function delete_to_sessions_destroy_only_user_for_that_session_can()
    {
        $this->actingAs($this->user);
        $response = $this->delete(route('sessions.destroy', $this->sessionCode));
        $response->assertRedirect(route('sessions'));
        $this->assertDatabaseMissing('session_codes', ['id' => $this->sessionCode->id]);

        $anotherUser = User::factory()->create();
        $anotherSessionCode = SessionCode::factory()->forUser($anotherUser)->create();
        $response = $this->delete(route('sessions.destroy', $anotherSessionCode));
        $response->assertStatus(403);
    }
}
?>
