<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class JobCategoryController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $query = JobCategory::query();
        $this->search($query, ['name', 'slug']);
        $categories = $query->paginate(20);
        return view('admin..job.job-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin..job.job-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = new JobCategory();
        $category->icon = $request->icon;
        $category->name = $request->name;
        $category->is_popular = $request->is_popular;
        $category->is_featured = $request->is_featured;
        $category->save();

        Notify::createdNotification();

        return redirect()->route('admin.job-categories.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = JobCategory::findOrFail($id);
        return view('admin..job.job-category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'icon' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = JobCategory::findOrFail($id);
        if ($request->filled('icon')) $category->icon = $request->icon;
        $category->name = $request->name;
        $category->is_popular = $request->is_popular;
        $category->is_featured = $request->is_featured;
        $category->save();

        Notify::updatedNotification();

        return redirect()->route('admin.job-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            JobCategory::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
