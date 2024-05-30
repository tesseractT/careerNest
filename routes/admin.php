<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CounterController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CustomPageBuilderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\IndustryTypeController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\JobExperienceController;
use App\Http\Controllers\Admin\JobRoleController;
use App\Http\Controllers\Admin\JobTypeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LearnMoreController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrganizationTypeController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SalaryTypeController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['guest:admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::group([
    'middleware' => ['auth:admin'],
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    /** Dashboard Route */
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /** Industry Type Route */
    Route::resource('industry-types', IndustryTypeController::class);

    /** Organzation Type Route */
    Route::resource('organization-types', OrganizationTypeController::class);

    /**Countries Route */
    Route::resource('countries', CountryController::class);

    /** State Route */
    Route::resource('states', StateController::class);

    /** City Route */
    Route::resource('cities', CityController::class);
    Route::get('get-states/{country_id}', [LocationController::class, 'getStatesOfCountry'])->name('get-states');

    /** Language Route */
    Route::resource('languages', LanguageController::class);

    /** Profession Route */
    Route::resource('professions', ProfessionController::class);

    /** Skills Route */
    Route::resource('skills', SkillController::class);

    /** Plan Route */
    Route::resource('plans', PlanController::class);

    /** Order Route */
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders/invoice/{id}', [OrderController::class, 'invoice'])->name('orders.invoice');

    /** Job Routes */
    Route::post('job-status/{id}', [JobController::class, 'changeStatus'])->name('job-status.update');
    Route::resource('jobs', JobController::class);

    /** Blog Routes */
    Route::resource('blogs', BlogController::class);

    /** Hero Section Routes */
    Route::resource('hero', HeroController::class);

    /** Why Choose Us Routes */
    Route::resource('why-choose-us', WhyChooseUsController::class);

    /** Learn More Routes */
    Route::resource('learn-more', LearnMoreController::class);

    /** Counter Routes */
    Route::resource('counter', CounterController::class);

    /** Review Routes */
    Route::resource('reviews', ReviewController::class);

    /** About Us Routes */
    Route::resource('abouts', AboutController::class);

    /** Custom Page Builder Routes */
    Route::resource('page-builder', CustomPageBuilderController::class);

    /** NewsLetter Routes */
    Route::get('newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');
    Route::delete('newsletters/{id}', [NewsletterController::class, 'destroy'])->name('newsletters.destroy');
    Route::post('newsletters/send', [NewsletterController::class, 'send'])->name('newsletters.send');

    /** Job Category Routes */
    Route::resource('job-categories', JobCategoryController::class);

    /** Education Routes */
    Route::resource('educations', EducationController::class);

    /** Job Type Route */
    Route::resource('job-types', JobTypeController::class);

    /** Salary Type Route */
    Route::resource('salary-types', SalaryTypeController::class);

    /** Tag Route */
    Route::resource('tags', TagController::class);

    /** Job Role Route */
    Route::resource('job-roles', JobRoleController::class);

    /** Job Experience Route */
    Route::resource('job-experiences', JobExperienceController::class);

    /** Payment Settings Route */
    Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('paypal-settings', [PaymentSettingController::class, 'updatePaypalSetting'])->name('paypal-settings.update');
    Route::post('stripe-settings', [PaymentSettingController::class, 'updateStripeSetting'])->name('stripe-settings.update');

    /** Site Settings Route */
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('general-settings', [SiteSettingController::class, 'updateGeneralSetting'])->name('general-settings.update');
});
