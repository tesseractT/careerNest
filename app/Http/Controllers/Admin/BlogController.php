<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCreateRequest;
use App\Http\Requests\Admin\BlogUpdateRequest;
use App\Models\Blog;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogController extends Controller
{
    use FileUploadTrait, Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Blog::query();
        $this->search($query, ['title', 'slug']);
        $blogs = $query->orderBy('id', 'desc')->paginate(20);

        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request, 'image');

        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->title = $request->title;
        $blog->author_id = auth()->user()->id;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->save();

        Notify::createdNotification();

        return redirect()->route('admin.blogs.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogUpdateRequest $request, string $id): RedirectResponse
    {
        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request, 'image');
            $blog->image = $imagePath;
        }

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->status = $request->status;
        $blog->save();

        Notify::updatedNotification();

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Blog::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
