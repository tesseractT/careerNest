<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CandidateLanguage;
use App\Models\Language;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LanguageController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:job attributes']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Language::query();
        $this->search($query, ['name']);
        $languages = $query->paginate(20);
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:languages,name']
        ]);

        $language = new Language();
        $language->name = $request->name;
        $language->save();

        Notify::createdNotification();

        return redirect()->route('admin.languages.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:languages,name,' . $id]
        ]);

        $language = Language::findOrFail($id);
        $language->name = $request->name;
        $language->save();

        Notify::updatedNotification();

        return redirect()->route('admin.languages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        //check if the language is being used
        $languageExists = CandidateLanguage::where('language_id', $id)->exists();
        if ($languageExists) {
            return response(['message' => 'This language is being used, cannot delete!'], 400);
        }
        try {
            Language::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
