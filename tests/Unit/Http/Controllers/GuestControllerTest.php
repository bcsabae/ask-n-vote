<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Guest;
use App\Models\SessionCode;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function route_q_and_a_login_form_renders_fine()
    {
        $response = $this->get(route('q-and-a.login.form'));

        $response->assertStatus(200);
    }

    /** @test */
    public function post_to_route_q_and_a_login_works_with_valid_data()
    {
        $sessionCode = SessionCode::factory()->create();

        $response = $this->post(route('q-and-a.login'), [
            'session_code' => $sessionCode->session_code,
            'name' => 'Guest Name',
        ]);

        $response->assertRedirect(route('questions.index'));
        $this->assertDatabaseHas('guests', [
            'name' => 'Guest Name',
            'session_code_id' => $sessionCode->id,
        ]);

        $guest = Guest::where('name', 'Guest Name')->first();

        $response->assertSessionHas('guest_id', $guest->id);
    }

    /** @test */
    public function validation_errors_for_store_function()
    {
        $sessionCode = SessionCode::factory()->create();
        $inactiveSessionCode = SessionCode::factory()->create(["is_active" => false]);
        Guest::factory()->forSession($sessionCode)->create(["name" => "Taken"]);

        $response = $this->post(route('q-and-a.login'), [
            'session_code' => '',
            'name' => 'Guest Name',
        ]);

        $response->assertSessionHasErrors('session_code');

        $response = $this->post(route('q-and-a.login'), [
            'session_code' => 'invalid_code',
            'name' => 'Guest Name',
        ]);

        $response->assertSessionHasErrors('session_code');

        $response = $this->post(route('q-and-a.login'), [
            'session_code' => $sessionCode->session_code,
            'name' => '',
        ]);

        $response->assertSessionHasErrors('name');

        $response = $this->post(route('q-and-a.login'), [
            'session_code' => $inactiveSessionCode->session_code,
            'name' => 'Guest Name',
        ]);

        $response->assertSessionHasErrors('session_code');

        $response = $this->post(route('q-and-a.login'), [
            'session_code' => $sessionCode->session_code,
            'name' => 'Taken',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function post_to_route_guest_ban_needs_user_authentication()
    {
        SessionCode::factory()->create();
        $guest = Guest::factory()->create();

        $response = $this->patch(route('guest.ban', $guest));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function session_code_of_guest_should_match_logged_in_users_session_code_when_banning()
    {
        $sessionCode = SessionCode::factory()->forUser($this->user)->create();
        $guest = Guest::factory()->forSession($sessionCode)->create();

        $anotherUser = User::factory()->create();
        $this->actingAs($anotherUser);

        $response = $this->patch(route('guest.ban', $guest), [
            'ban' => true
        ]);

        $response->assertStatus(403);
    }

    /** @test */
    public function successful_request_to_ban_guest_works()
    {
        $sessionCode = SessionCode::factory()->forUser($this->user)->create();
        $guest = Guest::factory()->forSession($sessionCode)->create();

        $this->actingAs($this->user);

        $response = $this->patch(route('guest.ban', $guest), [
            'ban' => true
        ]);

        $response->assertStatus(302);
        $this->assertTrue($guest->fresh()->banned === 1);
    }
}
?>
