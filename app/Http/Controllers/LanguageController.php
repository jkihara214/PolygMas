<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function edit(): Response
    {
        $languages = Language::all();
        return Inertia::render('Lang/Editer', [
            'languages' => $languages
        ]);
    }

    public function update(LanguageUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return Redirect::route('dashboard');
    }
}
