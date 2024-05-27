<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LocationController;
use App\Http\Controllers\Frontend\PricingPageController;
use App\Http\Controllers\Frontend\CheckoutPageController;
use App\Http\Controllers\Frontend\CompanyOrderController;
use App\Http\Controllers\Frontend\CompanyProfileController;
use App\Http\Controllers\Frontend\FrontendJobPageController;
use App\Http\Controllers\Frontend\CandidateProfileController;
use App\Http\Controllers\Frontend\CompanyDashboardController;
use App\Http\Controllers\Frontend\CandidateDashboardController;
use App\Http\Controllers\Frontend\CandidateEducationController;
use App\Http\Controllers\Frontend\CandidateExperienceController;
use App\Http\Controllers\Frontend\CandidateJobBookmarkController;
use App\Http\Controllers\Frontend\CandidateMyJobController;
use App\Http\Controllers\Frontend\FrontendBlogPageController;
use App\Http\Controllers\Frontend\FrontendCompanyPageController;
use App\Http\Controllers\Frontend\FrontendCandidatePageController;

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

/** Pricing Routes */
Route::get('pricing', PricingPageController::class)->name('pricing.index');
Route::get('checkout/{plxan_id}', CheckoutPageController::class)->name('pricing.checkout');

/** Find a Job Routes */
Route::get('find-a-job', [FrontendJobPageController::class, 'index'])->name('jobs.index');
Route::get('find-a-job/{slug}', [FrontendJobPageController::class, 'show'])->name('jobs.show');
Route::post('apply-job/{id}', [FrontendJobPageController::class, 'applyJob'])->name('apply-jobs.store');
Route::get('job-bookmark/{id}', [CandidateJobBookmarkController::class, 'save'])->name('job.bookmark');

/** Blog Route */
Route::get('blog', [FrontendBlogPageController::class, 'index'])->name('blogs.index');
Route::get('blog/{slug}', [FrontendBlogPageController::class, 'show'])->name('blogs.show');




/** Candidate Route */
Route::group(
    [
        'middleware' => ['auth', 'verified', 'user.role:candidate'],
        'prefix' => 'candidate',
        'as' => 'candidate.'
    ],
    function () {

        /** Dashboard Routes */
        Route::get('/dashboard', [CandidateDashboardController::class, 'index'])->middleware([])->name('dashboard');
        Route::get('/profile', [CandidateProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile/basic-info-update', [CandidateProfileController::class, 'basicInfoUpdate'])->name('profile.basic-info.update');
        Route::post('/profile/profile-info-update', [CandidateProfileController::class, 'profileInfoUpdate'])->name('profile.profile-info.update');

        /** My Job Routes */
        Route::get('/applied-jobs', [CandidateMyJobController::class, 'index'])->name('applied-jobs.index');
        Route::get('bookmarked-jobs', [CandidateJobBookmarkController::class, 'index'])->name('bookmarked-jobs.index');

        /** Experience and Education Routes */
        Route::resource('experience', CandidateExperienceController::class);
        Route::resource('education', CandidateEducationController::class);

        /** Account Settings Routes */
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

        /** Order Routes */
        Route::get('/orders', [CompanyOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [CompanyOrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/invoice/{id}', [CompanyOrderController::class, 'invoice'])->name('orders.invoice');

        /** Job Routes */
        Route::resource('jobs', JobController::class);
        Route::get('applications/{id}', [JobController::class, 'applications'])->name('jobs.applications');

        /** Payment Routes */
        Route::get('payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('payment/error', [PaymentController::class, 'paymentError'])->name('payment.error');

        /** Paypal */
        Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
        Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
        Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

        /** Stripe */
        Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
        Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
        Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
    }
);
