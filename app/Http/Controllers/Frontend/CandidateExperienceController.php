<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateExperienceStoreRequest;
use App\Models\CandidateExperience;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CandidateExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidateExperiences = CandidateExperience::where('candidate_id', auth()->user()->candidateProfile->id)->orderBy('id', 'desc')->get();

        return view('frontend.candidate-dashboard.profile.ajax-experience-table', compact('candidateExperiences'))->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidateExperienceStoreRequest $request): Response
    {
        $experience = new CandidateExperience();
        $experience->candidate_id = auth()->user()->candidateProfile->id;
        $experience->company = $request->company;
        $experience->department = $request->department;
        $experience->designation = $request->designation;
        $experience->start_date = $request->start_date;
        $experience->end_date = $request->end_date;
        $experience->currently_working = $request->filled('currently_working') ? 1 : 0;
        $experience->responsibilities = $request->responsibilities;
        $experience->save();

        return response(['message' => 'Experience added successfully.'], 200);
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
    public function edit(string $id): Response
    {
        $experience = CandidateExperience::findOrFail($id);

        return response($experience);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidateExperienceStoreRequest $request, string $id): Response
    {
        $experience = CandidateExperience::findOrFail($id);
        if ($experience->candidate_id !== auth()->user()->candidateProfile->id) {
            return response(['message' => 'Unauthorized'], 401);
        }
        $experience->company = $request->company;
        $experience->department = $request->department;
        $experience->designation = $request->designation;
        $experience->start_date = $request->start_date;
        $experience->end_date = $request->end_date;
        $experience->currently_working = $request->filled('currently_working') ? 1 : 0;
        $experience->responsibilities = $request->responsibilities;
        $experience->save();

        return response(['message' => 'Experience updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            $experience =  CandidateExperience::findOrFail($id);
            if ($experience->candidate_id !== auth()->user()->candidateProfile->id) {
                return response(['message' => 'Unauthorized'], 401);
            }
            $experience->delete();
            return response(['message' => 'Deleted Succesfully'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
