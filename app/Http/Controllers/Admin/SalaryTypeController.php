<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\SalaryType;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SalaryTypeController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = SalaryType::query();
        $this->search($query, ['name']);
        $salaryTypes = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.job.salary-type.index', compact('salaryTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.salary-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $jobType = new SalaryType();
        $jobType->name = $request->name;
        $jobType->save();

        Notify::createdNotification();

        return redirect()->route('admin.salary-types.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $salaryType = SalaryType::findOrFail($id);
        return view('admin.job.salary-type.edit', compact('salaryType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $salaryType = SalaryType::findOrFail($id);
        $salaryType->name = $request->name;
        $salaryType->save();

        Notify::updatedNotification();

        return redirect()->route('admin.salary-types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {

        // check if salary type is being used by any job
        $jobExists = Job::where('salary_type_id', $id)->exists();
        if ($jobExists) {
            return response(['message' => 'This salary type is being used by a job, you cannot delete it!'], 400);
        }
        try {
            SalaryType::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
