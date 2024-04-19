<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndustryType;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class IndustryTypeController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = IndustryType::query();
        $this->search($query, ['name']);
        $industryTypes = $query->paginate(20);
        return view('admin.industry-type.index', compact('industryTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.industry-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:industry_types,name']
        ]);

        $type = new IndustryType();
        $type->name = $request->name;
        $type->save();

        Notify::createdNotification();

        return redirect()->route('admin.industry-types.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $industryType = IndustryType::findOrFail($id);
        return view('admin.industry-type.edit', compact('industryType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:industry_types,name,' . $id]
        ]);

        $type = IndustryType::findOrFail($id);
        $type->name = $request->name;
        $type->save();

        Notify::updatedNotification();

        return redirect()->route('admin.industry-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):Response
    {
        try {
            IndustryType::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
