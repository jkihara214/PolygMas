<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageControllerTest extends TestCase
{
    public function test_lang_setting_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/lang/setting');

        $response->assertOk();
    }

    public function test_learning_lang_setting_information_can_be_updated(): void
    {
        $user = User::factory()->create();
        $languageId = Language::latest()->first()->id ?? Language::factory()->create()->id;

        $response = $this
            ->actingAs($user)
            ->patch('/lang/setting', [
                'language_id' => $languageId,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/dashboard');

        $user->refresh();

        $this->assertSame($languageId, $user->language_id);
    }
}
