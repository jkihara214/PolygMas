<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_lang_registration_screen_can_be_rendered(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get('/admin/lang/register');

        $response->assertStatus(200);
    }
}
