<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiaryRequest;
use App\Models\Diary;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\GeminiService;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DiaryController extends Controller
{
    protected $geminiService;

    public function __construct(GeminiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }

    public function create(): Response
    {
        return Inertia::render('Diary/Register');
    }

    public function store(DiaryRequest $request): RedirectResponse
    {
        $ques = [
            "今日の天気・気温はどうでしたか?",
            "今日どこで何を食べましたか?",
            "今日嬉しかった・楽しかったことは何ですか?",
            "今日つらかった・難しかったことは何ですか?"
        ];

        $ans = [
            $request->diary_a1,
            $request->diary_a2,
            $request->diary_a3,
            $request->diary_a4,
        ];

        if (count($ques) !== count($ans)) {
            throw new \Exception('質問と回答の数が一致しません。');
        }

        $user = Auth::user();
        $languageId = $user->language_id;
        $language = Language::find($languageId);

        if (!$language) {
            throw new \Exception('現在学習中の言語は存在しません。');
        }

        $message = '次の質問とその回答を参考に、ありそうなことや感じそうなことをそれぞれ一文付け加えて簡単な日記を日本語で作成し、その後、作成した日本語の日記を' . $language->jp_name .  'に翻訳してください。翻訳した日記は、"-----"の後に追記してください。';

        for ($i = 0; $i < count($ques); $i++) {
            $question = '質問' . $i + 1 . ':' .  $ques[$i];
            $answer = '回答' . $i + 1 . ':' .  $ans[$i];
            $message .= $question . ',' . $answer . ',';
        }

        $response = $this->geminiService->sendMessage($message);

        [$jp_text, $trans_text] = array_map('trim', explode("-----", $response));

        $diary = Diary::forLanguage($language->code)->create([
            'user_id' => $user->id,
            'language_id' => $user->language_id,
            'jp_text' => $jp_text,
            'trans_text' => $trans_text,
        ]);

        return Redirect::route('diary.register');
    }
}
