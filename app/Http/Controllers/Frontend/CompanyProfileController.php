<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CompanyEstablishmentInfoUpdateRequest;
use App\Http\Requests\Frontend\CompanyInfoUpdateRequest;
use App\Models\Company;
use App\Traits\FileUploadTrait;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rules;

class CompanyProfileController extends Controller
{
    use FileUploadTrait;
    function index(): View
    {
        $companyInfo = Company::where('user_id', auth()->user()->id)->first();
        return view('frontend.company-dashboard.profile.index', compact('companyInfo'));
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

        notify()->success('Company Info Updated Successfully');

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

        notify()->success('Establishment Info Updated Successfully');

        return redirect()->back();
    }

    function updateAccountInfo(Request $request): RedirectResponse
    {
        $validatedData =  $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
        ]);

        Auth::user()->update($validatedData);

        notify()->success('Account Info Updated Successfully');

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

        notify()->success('Password Updated Successfully');

        return redirect()->back();
    }
}
