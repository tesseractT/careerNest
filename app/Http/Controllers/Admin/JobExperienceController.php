<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\JobExperience;
use App\Services\Notify;
use App\Traits\Searchable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobExperienceController extends Controller
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
        $query = JobExperience::query();
        $this->search($query, ['name']);
        $jobExperiences = $query->orderBy('id', 'desc')->paginate(20);
        return view('admin.job.job-experience.index', compact('jobExperiences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.job.job-experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $jobExperience = new JobExperience();
        $jobExperience->name = $request->name;
        $jobExperience->save();

        Notify::createdNotification();

        return redirect()->route('admin.job-experiences.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $jobExperience = JobExperience::findOrFail($id);
        return view('admin.job.job-experience.edit', compact('jobExperience'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $jobExperience = JobExperience::findOrFail($id);
        $jobExperience->name = $request->name;
        $jobExperience->save();

        Notify::updatedNotification();

        return redirect()->route('admin.job-experiences.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //check if the job experience is being used in job
        $experienceExists = Job::where('job_experience_id', $id)->exists();
        $candidateExists = Candidate::where('experience_id', $id)->exists();
        if ($experienceExists) {
            return response(['message' => 'Job experience is being used in job, cannot delete!'], 500);
        }
        if ($candidateExists) {
            return response(['message' => 'Job experience is being used in candidate, cannot delete!'], 500);
        }
        try {
            JobExperience::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
