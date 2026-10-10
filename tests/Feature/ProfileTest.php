<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_editor_is_displayed_for_its_owner(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user)->get('/profile/'.$user->name_slug.'/edit')->assertOk()->assertSee($user->email);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        $editUrl = '/profile/'.$user->name_slug.'/edit';
        $this->actingAs($user)->from($editUrl)->put('/profile/'.$user->name_slug, [
            'email' => 'test@example.com', 'website' => 'https://example.com', 'bio' => 'Updated biography',
        ])->assertSessionHasNoErrors()->assertRedirect($editUrl);
        $user->refresh();
        $this->assertSame('test@example.com', $user->email);
        $this->assertSame('Updated biography', $user->bio);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();
        $editUrl = '/profile/'.$user->name_slug.'/edit';
        $this->actingAs($user)->from($editUrl)->put('/profile/'.$user->name_slug, [
            'email' => $user->email,
        ])->assertSessionHasNoErrors()->assertRedirect($editUrl);
        $this->assertNotNull($user->fresh()->email_verified_at);
    }

    public function test_users_cannot_update_someone_elses_profile(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $this->actingAs($user)->put('/profile/'.$other->name_slug, [
            'email' => 'changed@example.com',
        ])->assertForbidden();
        $this->assertSame($other->email, $other->fresh()->email);
    }

    public function test_invalid_or_duplicate_email_does_not_change_profile(): void
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $editUrl = '/profile/'.$user->name_slug.'/edit';
        foreach (['invalid-email', $other->email] as $email) {
            $this->actingAs($user)->from($editUrl)->put('/profile/'.$user->name_slug, [
                'email' => $email,
            ])->assertSessionHasErrors('email')->assertRedirect($editUrl);
            $this->assertSame($user->email, $user->fresh()->email);
        }
    }
}
