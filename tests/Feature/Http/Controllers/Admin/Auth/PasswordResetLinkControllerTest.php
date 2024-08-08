<?php

namespace Tests\Feature\Http\Controllers\Admin\Auth;

use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Admin;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\AdminResetPassword as ResetPasswordNotification;
use Tests\TestCase;

class PasswordResetLinkControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function test_admin_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/forgot-password');

        $response->assertStatus(200);
    }

    public function test_admin_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/admin/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPasswordNotification::class);
    }

    public function test_admin_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/admin/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPasswordNotification::class, function ($notification) {
            $response = $this->get('/admin/reset-password/' . $notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_admin_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/admin/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPasswordNotification::class, function ($notification) use ($admin) {
            $response = $this->post('/admin/reset-password', [
                'token' => $notification->token,
                'email' => $admin->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('admin.login'));

            return true;
        });
    }

    public function test_validation_error_check_to_reset_admin_password(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/admin/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPasswordNotification::class, function ($notification) use ($admin) {
            $response = $this->post('/admin/reset-password', [
                'token' => $notification->token,
                'email' => $admin->email,
                'password' => 'password',
                'password_confirmation' => 'wrong-password',
            ]);

            $response->assertSessionHasErrors('password');

            return true;
        });
    }
}
