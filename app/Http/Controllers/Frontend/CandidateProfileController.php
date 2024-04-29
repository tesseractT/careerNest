<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CandidateBasicProfileUpdateRequest;
use App\Http\Requests\Frontend\CandidateProfileInfoUpdateRequest;
use App\Models\Candidate;
use App\Models\CandidateLanguage;
use App\Models\CandidateSkill;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Profession;
use App\Models\Skill;
use App\Services\Notify;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CandidateProfileController extends Controller
{
    use FileUploadTrait;
    function index(): View
    {
        $candidate = Candidate::with(['skill', 'language'])->where('user_id', auth()->user()->id)->first();
        $experiences = Experience::all();
        $professions = Profession::all();
        $skills = Skill::all();
        $languages = Language::all();
        return view('frontend.candidate-dashboard.profile.index', compact('candidate', 'experiences', 'professions', 'skills', 'languages'));
    }

    /**
     * Update basic info of candidate
     *
     * @return RedirectResponse
     */
    function basicInfoUpdate(CandidateBasicProfileUpdateRequest $request): RedirectResponse
    {
        //Upload files
        $imagePath = $this->uploadFile($request, 'profile_picture');
        $cvPath = $this->uploadFile($request, 'cv');

        $data = [];
        if (!empty($imagePath)) $data['image'] = $imagePath;
        if (!empty($cvPath)) $data['cv'] =  $cvPath;
        $data['full_name'] = $request->full_name;
        $data['title'] = $request->title;
        $data['experience_id'] = $request->experience_level;
        $data['website'] = $request->website;
        $data['dob'] = $request->date_of_birth;

        //Updating data
        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $data
        );

        Notify::updatedNotification();

        return redirect()->back();
    }

    function profileInfoUpdate(CandidateProfileInfoUpdateRequest $request): RedirectResponse
    {
        $data = [];
        $data['gender'] = $request->gender;
        $data['marital_status'] = $request->marital_status;
        $data['profession_id'] = $request->profession;
        $data['status'] = $request->availability;
        $data['bio'] = $request->bio;

        //Updating data
        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            $data
        );

        $candidate = Candidate::where('user_id', auth()->user()->id)->first();

        //Deleting old languages and skills
        CandidateLanguage::where('candidate_id', $candidate->id)->delete();
        CandidateSkill::where('candidate_id', $candidate->id)->delete();

        //Updating languages
        foreach ($request->your_languages as $language) {
            $candidateLang = new CandidateLanguage();
            $candidateLang->candidate_id = $candidate->id;
            $candidateLang->language_id = $language;
            $candidateLang->save();
        }

        //Updating skills
        foreach ($request->your_skills as $skill) {
            $candidateSkill = new CandidateSkill();
            $candidateSkill->candidate_id = $candidate->id;
            $candidateSkill->skill_id = $skill;
            $candidateSkill->save();
        }

        Notify::updatedNotification();


        return redirect()->back();
    }
}
