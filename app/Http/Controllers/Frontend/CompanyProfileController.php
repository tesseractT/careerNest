<?php

namespace App\Http\Controllers\Frontend;

use Auth;
use App\Models\City;
use App\Models\State;
use App\Models\Company;
use App\Models\Country;
use App\Models\TeamSize;
use App\Services\Notify;
use Illuminate\View\View;
use App\Models\IndustryType;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use App\Models\OrganizationType;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Frontend\CompanyInfoUpdateRequest;
use App\Http\Requests\Frontend\CompanyEstablishmentInfoUpdateRequest;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;
    function index(): View
    {
        $companyInfo = Company::where('user_id', auth()->user()->id)->first();
        $industryTypes = IndustryType::all();
        $organizationTypes = OrganizationType::all();
        $teamSizes = TeamSize::all();
        $countries = Country::all();
        $states = State::select(['id', 'name', 'country_id'])->where('country_id', $companyInfo?->country)->get();
        $cities = City::select(['id', 'name', 'state_id', 'country_id'])->where('state_id', $companyInfo?->state)->get();
        return view('frontend.company-dashboard.profile.index', compact('companyInfo', 'industryTypes', 'organizationTypes', 'teamSizes', 'countries', 'states', 'cities'));
    }

    function updateCompanyInfo(CompanyInfoUpdateRequest $request): RedirectResponse
    {
        $logoPath = $this->uploadFile($request, 'logo');
        $bannerPath = $this->uploadFile($request, 'banner');

        $data = [];
        if (!empty($logoPath)) $data['logo'] = $logoPath;
        if (!empty($bannerPath)) $data['banner'] = $bannerPath;
        $data['name'] = $request->name;
        $data['bio'] = $request->bio;
        $data['vision'] = $request->vision;

        Company::updateOrCreate(
            [
                'user_id' => auth()->user()->id
            ],
            $data
        );

        if (isCompanyProfileComplete()) {
            Company::where('user_id', auth()->user()->id)->update([
                'profile_completed' => 1,
                'visibility' => 1,
            ]);
        }

        Notify::updatedNotification();


        return redirect()->back();
    }

    function updateEstablishmentInfo(CompanyEstablishmentInfoUpdateRequest $request): RedirectResponse
    {



        Company::updateOrCreate(
            [
                'user_id' => auth()->user()->id
            ],
            [
                'industry_type_id' => $request->industry_type,
                'organization_type_id' => $request->organization_type,
                'team_size_id' => $request->team_size,
                'establishment_date' => $request->establishment_date,
                'website' => $request->website,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'state' => $request->state,
                'city' => $request->city,
                'address' => $request->address,
                'map_link' => $request->map_link,
            ]
        );

        if (isCompanyProfileComplete()) {
            Company::where('user_id', auth()->user()->id)->update([
                'profile_completed' => 1,
                'visibility' => 1,
            ]);
        }

        Notify::updatedNotification();

        return redirect()->back();
    }

    function updateAccountInfo(Request $request): RedirectResponse
    {
        $validatedData =  $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
        ]);

        Auth::user()->update($validatedData);

        Notify::updatedNotification();

        return redirect()->back();
    }

    function updatePassword(Request $request): RedirectResponse
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
}
