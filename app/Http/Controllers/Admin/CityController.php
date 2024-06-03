<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CityController extends Controller
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

        $query = City::query();
        $query->with(['state', 'country']);
        $this->search($query, ['name']);
        $cities = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.location.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $countries = Country::all();
        return view('admin.location.city.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $city = new City();
        $city->name = $request->city;
        $city->state_id = $request->state;
        $city->country_id = $request->country;
        $city->save();

        Notify::createdNotification();

        return redirect()->route('admin.cities.index');
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
        $city = City::findOrFail($id);
        $countries = Country::all();
        $states = State::where('country_id', $city->country_id)->get();
        return view('admin.location.city.edit', compact('city', 'countries', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'country' => ['required', 'integer'],
            'state' => ['required', 'integer'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $city = City::findOrFail($id);
        $city->name = $request->city;
        $city->state_id = $request->state;
        $city->country_id = $request->country;
        $city->save();

        Notify::updatedNotification();

        return redirect()->route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            City::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
