<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LanguageControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_lang_registration_screen_can_be_rendered(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admin')->get('/admin/lang/register');

        $response->assertStatus(200);
    }

    public function test_new_languages_can_register(): void
    {
        Storage::fake('public');

        $admin = Admin::factory()->create();

        $image = UploadedFile::fake()->image('flag.jpg', 100, 100);

        Carbon::setTestNow(Carbon::create(2024, 8, 9, 12, 34, 56));

        $randomString = 'abcdefghij';
        Str::createRandomStringsUsing(function () use ($randomString) {
            return $randomString;
        });

        $response = $this->actingAs($admin, 'admin')->post('/admin/lang/register', [
            'jp_name' => '英語',
            'en_name' => 'English',
            'code' => 'en',
            'image' => $image,
        ]);
        $this->assertDatabaseHas('languages', ['jp_name' => '英語']);

        $expectedFileName = '20240809_123456_' . $randomString . '.jpg';

        Storage::disk('public')->assertExists('images/languages/' . $expectedFileName);

        $response->assertRedirect(route('admin.dashboard', absolute: false));

        Str::createRandomStringsNormally();
        Carbon::setTestNow();
    }

    public function test_validation_error_check_to_register_new_language(): void
    {
        Storage::fake('public');

        $admin = Admin::factory()->create();

        $image = UploadedFile::fake()->create(
            'flag.jpg',
            4 * 1024, // 4MB (キロバイト単位で指定)
            'image/jpeg'
        );

        $response = $this->actingAs($admin, 'admin')->post('/admin/lang/register', [
            'jp_name' => '英語',
            'en_name' => 'English',
            'code' => 'en',
            'image' => $image,
        ]);
        $response->assertSessionHasErrors('image');
    }
}
