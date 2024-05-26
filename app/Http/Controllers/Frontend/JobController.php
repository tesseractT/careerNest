<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Job;
use App\Models\Tag;
use App\Models\City;
use App\Models\Skill;
use App\Models\State;
use App\Models\JobTag;
use App\Models\Benefit;
use App\Models\Company;
use App\Models\Country;
use App\Models\JobRole;
use App\Models\JobType;
use App\Models\JobSkill;
use App\Services\Notify;
use App\Models\Education;
use Illuminate\View\View;
use App\Models\JobBenefit;
use App\Models\SalaryType;
use App\Traits\Searchable;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Models\JobExperience;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\JobCreateRequest;
use App\Models\AppliedJob;

class JobController extends Controller
{
    use Searchable;
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {

        $query = Job::query();
        $query->withCount('applications');
        $this->search($query, ['title', 'slug']);
        $jobs = $query->where('company_id', auth()->user()->company->id)->orderBy('id', 'desc')->paginate(20);
        return view('frontend.company-dashboard.job.index', compact('jobs'));
    }

    function applications(String $id): View
    {
        $applications = AppliedJob::where('job_id', $id)->paginate(20);
        $jobTitle = Job::select('title')->where('id', $id)->first();
        return view('frontend.company-dashboard.applications.index', compact('applications', 'jobTitle'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View | RedirectResponse
    {
        storePlanInformation();
        $userPlan = session('user_plan');
        if ($userPlan?->job_limit <= 0) {
            Notify::errorNotification('You have reached your job posting limit. Please upgrade or subscribe to a plan to post more jobs.');
            return redirect()->back();
        }
        $companies = Company::where(['profile_completed' => 1, 'visibility' => 1])->get();
        $categories = JobCategory::all();
        $countries = Country::all();
        $salaryTypes = SalaryType::all();
        $experiences = JobExperience::all();
        $jobRoles = JobRole::all();
        $educations = Education::all();
        $jobTypes = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('frontend.company-dashboard.job.create', compact('companies', 'categories', 'countries', 'salaryTypes', 'experiences', 'jobRoles', 'educations', 'jobTypes', 'tags', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobCreateRequest $request): RedirectResponse
    {
        if (session('user_plan')->featured_job_limit <= 0) {
            Notify::errorNotification('You have reached your featured job posting limit. Please upgrade your plan to post more featured jobs.');
            return redirect()->back();
        }
        if (session('user_plan')->highlight_job_limit <= 0) {
            Notify::errorNotification('You have reached your highlight job posting limit. Please upgrade your plan to post more highlight jobs.');
            return redirect()->back();
        }
        $job = new Job();
        $job->title = $request->title;
        $job->company_id = auth()->user()->company->id;
        $job->job_category_id = $request->category;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;

        $job->country_id = $request->country;
        $job->state_id = $request->state;
        $job->city_id = $request->city;
        $job->address = $request->address;

        $job->salary_mode = $request->salary_mode;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->custom_salary = $request->custom_salary;
        $job->salary_type_id = $request->salary_type;

        $job->job_experience_id = $request->experience;
        $job->job_role_id = $request->job_role;
        $job->education_id = $request->education;
        $job->job_type_id = $request->job_type;

        $job->apply_on = $request->receive_application;

        $job->featured = $request->featured;
        $job->highlight = $request->highlight;
        $job->description = $request->description;
        $job->save();

        //tags, benefits, skills
        foreach ($request->tags as $tag) {
            $createTag = new JobTag();
            $createTag->job_id = $job->id;
            $createTag->tag_id = $tag;
            $createTag->save();
        }

        $benefits = explode(',', $request->benefits);

        foreach ($benefits as $benefit) {
            $createBenefit = new Benefit();
            $createBenefit->company_id = $job->company_id;
            $createBenefit->name = $benefit;
            $createBenefit->save();

            //Store Job Benefits
            $jobBenefit = new JobBenefit();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $createBenefit->id;
            $jobBenefit->save();
        }

        foreach ($request->skills as $skill) {
            //Store Job Skills
            $jobSkill = new JobSkill();
            $jobSkill->job_id = $job->id;
            $jobSkill->skill_id = $skill;
            $jobSkill->save();
        }

        if ($job) {
            $userPlan = auth()->user()->company->userPlan;
            $userPlan->job_limit = $userPlan->job_limit - 1;
            if ($job->featured == 1) {
                $userPlan->featured_job_limit = $userPlan->featured_job_limit - 1;
            }
            if ($job->highlight == 1) {
                $userPlan->highlight_job_limit = $userPlan->highlight_job_limit - 1;
            }
            $userPlan->save();
            storePlanInformation();
        }

        Notify::createdNotification();

        return to_route('company.jobs.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $job = Job::findOrFail($id);
        abort_if($job->company_id !== auth()->user()->company->id, 403);
        $companies = Company::where(['profile_completed' => 1, 'visibility' => 1])->get();
        $categories = JobCategory::all();
        $countries = Country::all();
        $states = State::where('country_id', $job->country_id)->get();
        $cities = City::where('state_id', $job->state_id)->get();
        $salaryTypes = SalaryType::all();
        $experiences = JobExperience::all();
        $jobRoles = JobRole::all();
        $educations = Education::all();
        $jobTypes = JobType::all();
        $tags = Tag::all();
        $skills = Skill::all();
        return view('frontend.company-dashboard.job.edit', compact('companies', 'categories', 'countries', 'salaryTypes', 'experiences', 'jobRoles', 'educations', 'jobTypes', 'tags', 'skills', 'job', 'states', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobCreateRequest $request, string $id): RedirectResponse
    {
        $job = Job::findOrFail($id);
        abort_if($job->company_id !== auth()->user()->company->id, 403);
        $job->title = $request->title;
        $job->job_category_id = $request->category;
        $job->vacancies = $request->vacancies;
        $job->deadline = $request->deadline;

        $job->country_id = $request->country;
        $job->state_id = $request->state;
        $job->city_id = $request->city;
        $job->address = $request->address;

        $job->salary_mode = $request->salary_mode;
        $job->min_salary = $request->min_salary;
        $job->max_salary = $request->max_salary;
        $job->custom_salary = $request->custom_salary;
        $job->salary_type_id = $request->salary_type;

        $job->job_experience_id = $request->experience;
        $job->job_role_id = $request->job_role;
        $job->education_id = $request->education;
        $job->job_type_id = $request->job_type;

        $job->apply_on = $request->receive_application;

        $job->featured = $request->featured;
        $job->highlight = $request->highlight;
        $job->description = $request->description;
        $job->save();

        //tags, benefits, skills
        JobTag::where('job_id', $id)->delete();
        foreach ($request->tags as $tag) {
            $createTag = new JobTag();
            $createTag->job_id = $job->id;
            $createTag->tag_id = $tag;
            $createTag->save();
        }

        $selectedBenefits = JobBenefit::where('job_id', $id);
        foreach ($selectedBenefits->get() as $selectedBenefit) {
            Benefit::find($selectedBenefit->benefit_id)->delete();
        }
        $selectedBenefits->delete();

        $benefits = explode(',', $request->benefits);

        foreach ($benefits as $benefit) {
            $createBenefit = new Benefit();
            $createBenefit->company_id = $job->company_id;
            $createBenefit->name = $benefit;
            $createBenefit->save();

            //Store Job Benefits
            $jobBenefit = new JobBenefit();
            $jobBenefit->job_id = $job->id;
            $jobBenefit->benefit_id = $createBenefit->id;
            $jobBenefit->save();
        }

        JobSkill::where('job_id', $id)->delete();
        foreach ($request->skills as $skill) {
            //Store Job Skills
            $jobSkill = new JobSkill();
            $jobSkill->job_id = $job->id;
            $jobSkill->skill_id = $skill;
            $jobSkill->save();
        }

        Notify::updatedNotification();

        return to_route('company.jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        try {
            Job::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (\Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again!'], 500);
        }
    }
}
