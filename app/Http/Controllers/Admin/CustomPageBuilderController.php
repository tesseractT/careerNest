<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPageBuilder;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CustomPageBuilderController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:site pages']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View

    {
        $query = CustomPageBuilder::query();
        $this->search($query, ['page_name']);
        $pages = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.page-builder.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.page-builder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'page_name' => ['required', 'string', 'max:255'],
            'page_content' => ['required'],
        ]);

        $page = new CustomPageBuilder();
        $page->page_name = $request->page_name;
        $page->page_content = $request->page_content;
        $page->save();

        Notify::createdNotification();

        return redirect()->route('admin.page-builder.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $page = CustomPageBuilder::findOrFail($id);
        return view('admin.page-builder.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'page_name' => ['required', 'string', 'max:255'],
            'page_content' => ['required'],
        ]);

        $page = CustomPageBuilder::findOrFail($id);
        $page->page_name = $request->page_name;
        $page->page_content = $request->page_content;
        $page->save();

        Notify::updatedNotification();

        return redirect()->route('admin.page-builder.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            CustomPageBuilder::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
