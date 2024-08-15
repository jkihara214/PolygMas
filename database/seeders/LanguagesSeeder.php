<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imagePath = public_path('images/seeds/usa.jpg');

        $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $date = Carbon::now()->format('Ymd');
        $time = Carbon::now()->format('His');
        $randomString = Str::random(10);
        $newImageName = $date . '_' . $time . '_' . $randomString . '.' . $extension;

        Storage::disk('public')->put('images/languages/' . $newImageName, file_get_contents($imagePath));

        DB::table('languages')->insert([
            [
                'jp_name' => '英語',
                'en_name' => 'English',
                'code' => 'en',
                'image' => $newImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jp_name' => '韓国語',
                'en_name' => 'Korean',
                'code' => 'ko',
                'image' => $newImageName,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
