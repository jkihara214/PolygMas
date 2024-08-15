<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diaries_en', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->text('jp_text');
            $table->text('trans_text');
            $table->timestamps();
        });

        Schema::create('diaries_fr', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->text('jp_text');
            $table->text('trans_text');
            $table->timestamps();
        });

        Schema::create('diaries_de', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->text('jp_text');
            $table->text('trans_text');
            $table->timestamps();
        });

        Schema::create('diaries_es', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->text('jp_text');
            $table->text('trans_text');
            $table->timestamps();
        });

        Schema::create('diaries_zh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->text('jp_text');
            $table->text('trans_text');
            $table->timestamps();
        });

        Schema::create('diaries_ko', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('language_id')->constrained();
            $table->text('jp_text');
            $table->text('trans_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diaries_en');
        Schema::dropIfExists('diaries_fr');
        Schema::dropIfExists('diaries_de');
        Schema::dropIfExists('diaries_es');
        Schema::dropIfExists('diaries_zh');
        Schema::dropIfExists('diaries_ko');
    }
};
