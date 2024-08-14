<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    public function create(): Response
    {
        $languages = Language::all();
        return Inertia::render('Lang/Register', [
            'languages' => $languages
        ]);
    }
}
