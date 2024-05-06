<?php

use App\Http\Controllers\Frontend\CandidateDashboardController;
use App\Http\Controllers\Frontend\CandidateEducationController;
use App\Http\Controllers\Frontend\CandidateExperienceController;
use App\Http\Controllers\Frontend\CandidateProfileController;
use App\Http\Controllers\Frontend\CompanyDashboardController;
use App\Http\Controllers\Frontend\CompanyProfileController;
use App\Http\Controllers\Frontend\FrontendCandidatePageController;
use App\Http\Controllers\Frontend\FrontendCompanyPageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('get-state/{country_id}', [LocationController::class, 'getState'])->name('get-states');
Route::get('get-city/{state_id}', [LocationController::class, 'getCity'])->name('get-cities');

/** Company Route */
Route::get('companies', [FrontendCompanyPageController::class, 'index'])->name('companies.index');
Route::get('companies/{slug}', [FrontendCompanyPageController::class, 'show'])->name('companies.show');

/** Candidate Route */
Route::get('candidates', [FrontendCandidatePageController::class, 'index'])->name('candidates.index');
Route::get('candidates/{slug}', [FrontendCandidatePageController::class, 'show'])->name('candidates.show');






/** Candidate Route */
Route::group(
    [
        'middleware' => ['auth', 'verified', 'user.role:candidate'],
        'prefix' => 'candidate',
        'as' => 'candidate.'
    ],
    function () {
        Route::get('/dashboard', [CandidateDashboardController::class, 'index'])->middleware([])->name('dashboard');
        Route::get('/profile', [CandidateProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/basic-info-update', [CandidateProfileController::class, 'basicInfoUpdate'])->name('profile.basic-info.update');
        Route::post('/profile/profile-info-update', [CandidateProfileController::class, 'profileInfoUpdate'])->name('profile.profile-info.update');


        Route::resource('experience', CandidateExperienceController::class);
        Route::resource('education', CandidateEducationController::class);

        Route::post('/profile/account-settings-update', [CandidateProfileController::class, 'accountSettingsUpdate'])->name('profile.account-settings.update');
        Route::post('/profile/account-email-update', [CandidateProfileController::class, 'accountEmailUpdate'])->name('profile.account-email.update');
        Route::post('/profile/account-password-update', [CandidateProfileController::class, 'accountPasswordUpdate'])->name('profile.account-password.update');
    }
);

/** Company Route */
Route::group(
    [
        'middleware' => ['auth', 'verified', 'user.role:company'],
        'prefix' => 'company',
        'as' => 'company.'
    ],

    function () {

        /** Dashboard Routes */
        Route::get('/dashboard', [CompanyDashboardController::class, 'index'])->name('dashboard');

        /** Company Profile Routes */
        Route::get('/profile', [CompanyProfileController::class, 'index'])->name('profile');
        Route::post('/profile/company-info', [CompanyProfileController::class, 'updateCompanyInfo'])->name('profile.company-info');
        Route::post('/profile/establishment-info', [CompanyProfileController::class, 'updateEstablishmentInfo'])->name('profile.establishment-info');
        Route::post('/profile/account-info', [CompanyProfileController::class, 'updateAccountInfo'])->name('profile.account-info');
        Route::post('/profile/password-update', [CompanyProfileController::class, 'updatePassword'])->name('profile.password-update');
    }
);
