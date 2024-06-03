<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobRole;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobRoleController extends Controller
{
    use Searchable;


    public function __construct()
    {
        $this->middleware(['permission:job role']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $query = JobRole::query();
        $this->search($query, ['name']);
        $jobRoles = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.job.job-role.index', compact('jobRoles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.job-role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $jobRole = new JobRole();
        $jobRole->name = $request->name;
        $jobRole->save();

        Notify::createdNotification();

        return redirect()->route('admin.job-roles.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $jobRole = JobRole::findOrFail($id);
        return view('admin.job.job-role.edit', compact('jobRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $jobRole = JobRole::findOrFail($id);
        $jobRole->name = $request->name;
        $jobRole->save();

        Notify::updatedNotification();

        return redirect()->route('admin.job-roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if the job role is associated with any job
        $jobExists = Job::where('job_role_id', $id)->exists();
        if ($jobExists) {
            return response(['message' => 'This job role is associated with some jobs, please remove them first!'], 400);
        }
        try {
            JobRole::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
