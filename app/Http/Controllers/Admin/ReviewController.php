<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewCreateRequest;
use App\Http\Requests\Admin\ReviewUpdateRequest;
use App\Models\Review;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReviewController extends Controller
{
    use FileUploadTrait, Searchable;

    public function __construct()
    {
        $this->middleware(['permission:sections']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Review::query();
        $this->search($query, ['name', 'title', 'rating']);
        $reviews = $query->paginate(20);
        return view('admin.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $review = Review::all();
        return view('admin.review.create', compact('review'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewCreateRequest $request): RedirectResponse
    {
        $imagePath = $this->uploadFile($request, 'image');

        $review = new Review();
        $review->name = $request->name;
        $review->title = $request->title;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->image = $imagePath;
        $review->save();

        Notify::createdNotification();

        return redirect()->route('admin.reviews.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $review = Review::findOrFail($id);
        return view('admin.review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewUpdateRequest $request, string $id): RedirectResponse
    {
        $review = Review::findOrFail($id);
        $imagePath = $review->image;

        if ($request->hasFile('image')) {
            $imagePath = $this->uploadFile($request, 'image');
        }

        $review->name = $request->name;
        $review->title = $request->title;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->image = $imagePath;
        $review->save();

        Notify::updatedNotification();

        return redirect()->route('admin.reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Review::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
