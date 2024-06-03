<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\Notify;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;

class CountryController extends Controller
{
    use Searchable;

    public function __construct()
    {
        $this->middleware(['permission:job locations']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = Country::query();
        $this->search($query, ['name']);
        $countries = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.location.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.location.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name'],
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->save();

        Notify::createdNotification();

        return redirect()->route('admin.countries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $countries = Country::findOrFail($id);
        return view('admin.location.country.edit', compact('countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'max:255', 'unique:countries,name,' . $id],
        ]);

        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->save();

        Notify::updatedNotification();

        return redirect()->route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Country::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
