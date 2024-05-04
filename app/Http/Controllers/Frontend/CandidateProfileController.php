<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\City;
use App\Models\User;
use App\Models\Skill;
use App\Models\State;
use App\Models\Country;
use App\Models\Language;
use App\Services\Notify;
use App\Models\Candidate;
use Illuminate\View\View;
use App\Models\Experience;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\CandidateSkill;
use App\Traits\FileUploadTrait;
use Illuminate\Validation\Rules;
use App\Models\CandidateLanguage;
use App\Models\CandidateEducation;
use App\Models\CandidateExperience;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\CandidateProfileInfoUpdateRequest;
use App\Http\Requests\Frontend\CandidateBasicProfileUpdateRequest;
use App\Http\Requests\Frontend\CandidateAccountSettingsUpdateRequest;

class CandidateProfileController extends Controller
{
    use FileUploadTrait;
    function index(): View
    {
        $candidate = Candidate::with(['skill', 'language'])->where('user_id', auth()->user()->id)->first();
        $candidateExperiences = CandidateExperience::where('candidate_id', $candidate?->id)->orderBy('id', 'desc')->get();
        $candidateEducation = CandidateEducation::where('candidate_id', $candidate?->id)->orderBy('id', 'desc')->get();
        $experiences = Experience::all();
        $professions = Profession::all();
        $skills = Skill::all();
        $languages = Language::all();
        $countries = Country::all();
        $states = State::where('country_id', $candidate?->country)->get();
        $cities = City::where('state_id', $candidate?->state)->get();
        return view('frontend.candidate-dashboard.profile.index', compact('candidate', 'experiences', 'professions', 'skills', 'languages', 'candidateExperiences', 'candidateEducation', 'countries', 'states', 'cities'));
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

        $this->updateProfileCompleteStatus();


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

        $this->updateProfileCompleteStatus();

        Notify::updatedNotification();


        return redirect()->back();
    }


    // Account Settings Update

    function accountSettingsUpdate(CandidateAccountSettingsUpdateRequest $request): RedirectResponse
    {
        Candidate::updateOrCreate(
            ['user_id' => auth()->user()->id],
            [
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'phone_one' => $request->phone,
                'phone_two' => $request->secondary_phone,
                'email' => $request->email,
            ]
        );

        $this->updateProfileCompleteStatus();

        Notify::updatedNotification();

        return redirect()->back();
    }


    // Account Email Update
    function accountEmailUpdate(Request $request): RedirectResponse
    {
        $request->validate([
            'account_email' => ['required', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id,]
        ]);

        Auth::user()->update([
            'email' => $request->account_email,
        ]);

        Notify::updatedNotification();

        return redirect()->back();
    }


    // Account Password Update

    function accountPasswordUpdate(Request $request): RedirectResponse
    {
        $validatedData =  $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => bcrypt($validatedData['password'])
        ]);

        Notify::updatedNotification();

        return redirect()->back();
    }


    // Update Profile Complete
    function updateProfileCompleteStatus(): void
    {
        if (isCandidateProfileComplete()) {
            Candidate::where('user_id', auth()->user()->id)->update([
                'profile_complete' => 1,
                'visibility' => 1,
            ]);
        }

        // if (!isCandidateProfileComplete()) {
        //     Candidate::where('user_id', auth()->user()->id)->update([
        //         'profile_complete' => 0,
        //         'visibility' => 0,
        //     ]);
        // }
    }
}
