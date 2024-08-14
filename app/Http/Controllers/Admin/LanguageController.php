<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LanguageController extends Controller
{
    public function index(): Response
    {
        $languages = Language::all();
        return Inertia::render('Admin/Lang/Index', [
            'languages' => $languages
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/Lang/Register');
    }

    public function store(LanguageRequest $request): RedirectResponse
    {
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $date = Carbon::now()->format('Ymd');
        $time = Carbon::now()->format('His');
        $randomString = Str::random(10);
        $imageName = $date . '_' . $time . '_' . $randomString . '.' . $extension;

        Storage::disk('public')->put('images/languages/' . $imageName, file_get_contents($image));

        Language::create([
            'jp_name' => $request->jp_name,
            'en_name' => $request->en_name,
            'code' => $request->code,
            'image' => $imageName,
        ]);

        return redirect(route('admin.lang.index', absolute: false));
    }
}
