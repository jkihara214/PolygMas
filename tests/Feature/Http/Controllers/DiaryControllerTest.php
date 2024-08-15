<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiaryControllerTest extends TestCase
{
    // public function test_diary_history_list_page_is_displayed(): void
    // {
    //     // language_id が未設定
    //     $user = User::factory()->create();

    //     $response = $this
    //         ->actingAs($user)
    //         ->get('/diary');

    //     $response->assertOk();
    // }

    public function test_diary_create_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/diary/register');

        $response->assertOk();
    }

    // public function test_diary_information_can_be_stored(): void
    // {
    //     $user = User::factory()->create();
    //     $tableName = "diary_" . $code;

    //     $response = $this
    //         ->actingAs($user)
    //         ->post('/diary/register', [
    //             'diary_q1' => "雨が止んだ後蒸し暑かった",
    //             'diary_q2' => "東京でラーメン",
    //             'diary_q3' => "虹が見えた",
    //             'diary_q4' => "水たまりを踏んでしまった",
    //         ]);

    //     $response->assertSessionHasNoErrors();

    //     $this->assertDatabaseHas($tableName, []);
    // }
}
